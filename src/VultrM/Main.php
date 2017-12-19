<?php

namespace AVENDA;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\level\Level;
use pocketmine\Player;
// Linkage by Commands
use VultrM\command\TopMoneyCommand;
use VultrM\command\PayMoneyCommand;
use VultrM\command\MyMoneyCommand;
use VultrM\command\SeeMoneyCommand;
use VultrM\command\GiveMoneyCommand;
use VultrM\command\SetMoneyCommand;
// Linkage by Events
use VultrM\event\AddMoneyEvent;
use VultrM\event\ReduceMoneyEvent;
use VultrM\event\GetRankByPlayerEvent;
use VultrM\event\MyMoneyEvent;
use VultrM\event\GetRankEvent;
use VultrM\event\SetMonetEvent;

class Main extends PluginBase implements Listener {
	private static $instance = null;
	public $money, $mDB;
	public $tag = "§c§l[VirturlM]§7§o";
	public function onEnable() {
		@mkdir ( $this->getDataFolder () );
		$this->money = new Config ( $this->getDataFolder () . "money.yml", Config::YAML );
		$this->mDB = $this->money->getAll ();
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
		$this->registerCommand ();
	}
	public function registerCommands() {
		$this->TopMoneyCommand = new TopMoneyCommand ( $this );
		$this->PayMoneyCommand = new PayMoneyCommand ( $this );
		$this->SetMoneyCommand = new SetMoneyCommand ( $this );
		$this->GiveMoneyCommand = new GiveMoneyCommand ( $this );
		$this->MyMoneyCommand = new MyMoneyCommand ( $this );
		$this->SeeMoneyCommand = new SeeMoneyCommand ( $this );
		$this->ReduceMoneyCommand = new ReduceMoneyCommand ( $this );
	}
	public function registerEvents() {
		$this->MyMoneyEvent = new MyMoneyEvent ( $this );
		$this->AddMoneyEvent = new AddMoneyEvent ( $this );
		$this->ReduceMoneyEvent = new ReduceMoneyEvent ( $this );
		$this->GetRankByPlayerEvent = new GetRankByPlayer ( $this );
		$this->GetRankEvent = new GetRankEvent ( $this );
		$this->SetMoneyEvent = new SetMoneyEvent ( $this );
	}
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) {
		$cmd = $command->getName ();
		if ($cmd == "내돈") {
			$this->MyMoneyCommand->onCommand ( $sender, $command, $label, $args );
			return;
		}
		if ($cmd == "돈보기") {
			$this->SeeMoneyCommand->onCommand ( $sender, $command, $label, $args );
			return;
		}
		if ($cmd == "돈지불") {
			$this->PayMoneyCommand->onCommand ( $sender, $command, $label, $args );
			return;
		}
		if ($cmd == "돈순위") {
			$this->TopMoneyCommand->onCommand ( $sender, $command, $label, $args );
			return;
		}
		if ($cmd == "돈설정") {
			$this->SetMoneyCommand->onCommand ( $sender, $command, $label, $args );
			return;
		}
		if ($cmd == "돈주기") {
			$this->GiveMoneyCommand->onCommand ( $sender, $command, $label, $args );
			return;
		}
		if ($cmd == "돈뺏기") {
			$this->ReduceMoneyCommand->onCommand ( $sender, $command, $label, $args );
			return;
		}
	}
	public function getMessage(Player $player) {
		if ($player->isOp ()) {
			$player->sendMessage ( $this->tag . " /내돈 - 자신의 돈을 확인" );
			$player->sendMessage ( $this->tag . " /돈보기 [닉네임] - [닉네임]의 돈을 확인" );
			$player->sendMessage ( $this->tag . " /돈지불 [닉네임] [금액] - [닉네임]에게 [금액]만큼의 돈을 지불" );
			$player->sendMessage ( $this->tag . " /돈순위 [페이지] - 돈순위를 봅니다." );
			$player->sendMessage ( $this->tag . " /돈설정 [닉네임] [금액] - [닉네임]의 돈을 [금액]으로 설정합니다." );
			$player->sendMessage ( $this->tag . " /돈뺏기 [닉네임] [금액] - [닉네임]의 돈을 [금액]만큼 뺏습니다." );
		} else {
			$player->sendMessage ( $this->tag . " /내돈 - 자신의 돈을 확인" );
			$player->sendMessage ( $this->tag . " /돈보기 [닉네임] - [닉네임]의 돈을 확인" );
			$player->sendMessage ( $this->tag . " /돈지불 [닉네임] [금액] - [닉네임]에게 [금액]만큼의 돈을 지불" );
			$player->sendMessage ( $this->tag . " /돈순위 [페이지] - 돈순위를 봅니다." );
		}
	}
	public function addmoney(Player $player, $amount) {
		$name = strtolower ( $player->getName () );
		$this->getServer ()->getPluginManager ()->callEvent ( $event = new AddMoneyEvent ( $player, $amount ) );
		if (! $event->isCancelled ()) {
			$this->mDB [$name] ["money"] += $amount;
		}
	}
	public function reducemoney(Player $player, $amount) {
		$name = strtolower ( $player->getName () );
		$this->getServer ()->getPluginManager ()->callEvent ( $event = new ReduceMoneyEvent ( $player, $amount ) );
		if (! $event->isCancelled ()) {
			$this->mDB [$name] ["money"] -= $amount;
		}
	}
	public function mymoney(Player $player) {
		$name = strtolower ( $player->getName () );
		$this->getServer ()->getPluginManager ()->callEvent ( $event = new MyMoneyEvent ( $player ) );
		if (! $event->isCancelled ()) {
			return $this->mDB [$name] ["money"];
		}
	}
	public function setmoney(Player $player, $amount) {
		$this->getServer ()->getPluginManager ()->callEvent ( $event = new SetMoneyEvent ( $player, $amount ) );
		if (! $event->isCancelled ()) {
			$name = strtolower ( $player->getName () );
			$this->mDB [$name] ["money"] = $amount;
		}
	}
	public function getRank($num) {
	}
	public function getRankByPlayer(Player $player) {
	}
	public function message(Player $player, $msg) {
		$player->sendMessage ( $this->tag . " " . $msg );
	}
	/*
	 * @return VirturlMoney
	 */
	public static function getInstance() {
		return self::$instance;
	}
}
