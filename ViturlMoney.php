<?php

namespace AVENDA;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use pocketmine\level\Level;
// Linkage
use AVENDA\command\AddMoneyCommand;
use AVENDA\command\RemoveMoneyCommand;
use AVENDA\command\TopMoneyCommand;
use AVENDA\command\PayMoneyCommand;
use AVENDA\command\SetMoneyCommand;
use AVENDA\command\MyMoneyCommand;
use AVENDA\command\SeeMoneyCommand;
use pocketmine\Player;

class ViturlMoney extends PluginBase implements Listener {
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
	}
	public function registerEvents() {
		$this->MyMoneyEvent = new MyMoneyEvent ( $this );
		$this->AddMoneyEvent = new AddMoneyEvent ( $this );
		$this->ReduceMoneyEvent = new ReduceMoneyEvent ( $this );
		$this->GetRankByPlayerEvent = new GetRankByPlayer ( $this );
		$this->GetRankEvent = new GetRankEvent ( $this );
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
	public function addMoney(Player $player, $amount) {
		$name = strtolower ( $player->getName () );
		$this->mDB [$name] ["money"] += $amount;
	}
	public function reduceMoney(Player $player, $amount) {
		$name = strtolower ( $player->getName () );
		$this->mDB [$name] ["money"] -= $amount;
	}
	public function myMoney(Player $player) {
		$name = strtolower ( $player->getName () );
		return $this->mDB [$name] ["money"];
	}
	public function getRank($num) {
	}
	public function getRankByPlayer(Player $player) {
	}
	/*
	 * @return VirturlMoney
	 */
	public static function getInstance() {
		return self::$instance;
	}
}
