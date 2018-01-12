<?php

namespace VultrM;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\utils\Config;
use VultrM\commands\MyMoneyCommand;
use VultrM\commands\GiveMoneyCommand;
use VultrM\commands\AddMoneyCommand;
use VultrM\commands\SeeMoneyCommand;
use VultrM\commands\TopMoneyCommand;
use VultrM\commands\ReduceMoneyCommand;
use VultrM\commands\SetMoneyCommand;

class VultrM extends PluginBase implements Listener {
	public $money, $mDB;
	private static $instance = null;
	public $tag = "§b§l[VultrM]§7";
	public function onEnable() {
		@mkdir ( $this->getDataFolder () );
		$this->money = new Config ( $this->getDataFolder () . "money.yml", Config::YAML );
		$this->mDB = $this->money->getAll ();
		$this->MyMoneyCommand = new MyMoneyCommand ( $this );
		$this->GiveMoneyCommand = new GiveMoneyCommand ( $this );
		$this->AddMoneyCommand = new AddMoneyCommand ( $this );
		$this->SeeMoneyCommand = new SeeMoneyCommand ( $this );
		$this->TopMoneyCommand = new TopMoneyCommand ( $this );
		$this->ReduceMoneyCommand = new ReduceMoneyCommand ( $this );
		$this->SetMoneyCommand = new SetMoneyCommand ( $this );
		$this->getServer ()->getPluginManager ()->registerEvents ( $this, $this );
	}
	public function onLoad() {
		self::$instance = $this;
	}
	public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool {
		$cmd = $command->getName ();
		if ($cmd == "내돈") {
			if (! $player instanceof Player) {
				$player->sendMessage ( $this->tag . " 서버안에서만 입력이 가능합니다." );
				return true;
			}
			$this->MyMoneyCommand->onCommand ( $player, $label, $args );
		} else if ($cmd == "돈지불") {
			if (! $player instanceof Player) {
				$player->sendMessage ( $this->tag . " 서버안에서만 입력이 가능합니다." );
				return true;
			}
			$this->GiveMoneyCommand->onCommand ( $player, $label, $args );
		} else if ($cmd == "돈순위") {
			if (! $player instanceof Player) {
				$player->sendMessage ( $this->tag . " 서버안에서만 입력이 가능합니다." );
				return true;
			}
			$this->TopMoneyCommand->onCommand ( $player, $label, $args );
		} else if ($cmd == "돈보기") {
			if (! $player instanceof Player) {
				$player->sendMessage ( $this->tag . " 서버안에서만 입력이 가능합니다." );
				return true;
			}
			$this->SeeMoneyCommand->onCommand ( $player, $label, $args );
		} else if ($cmd == "돈뺏기") {
			if (! $player instanceof Player) {
				$player->sendMessage ( $this->tag . " 서버안에서만 입력이 가능합니다." );
				return true;
			}
			$this->ReduceMoneyCommand->onCommand ( $sender, $label, $args );
		} else if ($cmd == "돈주기") {
			if (! $player instanceof Player) {
				$player->sendMessage ( $this->tag . " 서버안에서만 입력이 가능합니다." );
				return true;
			}
			$this->AddMoneyCommand->onCommand ( $player, $label, $args );
		} else if ($cmd == "돈설정") {
			if (! $player instanceof Player) {
				$player->sendMessage ( $this->tag . " 서버안에서만 입력이 가능합니다." );
				return true;
			}
			$this->SetMoneyCommand->onCommand ( $player, $label, $args );
		}
		return true;
	}
	public function Join(PlayerJoinEvent $event) {
		$player = $event->getPlayer ();
		$name = strtolower ( $player->getName () );
		if (! isset ( $this->mDB [$name] )) {
			$this->mDB [$name] = 1000;
			$this->save ();
		}
	}
	public function save() {
		$this->money->setAll ( $this->mDB );
		$this->money->save ();
	}
	/*
	 * public function moneyconfig() {
	 * return $this->mDB;
	 * }
	 */
	public function msg(Player $player, $msg) {
		$player->sendMessage ( $this->tag . " " . $msg );
	}
	public function mymoney(Player $player) {
		$name = strtolower ( $player->getName () );
		return $this->mDB [$name];
	}
	public function setmoney($player, $m) {
		$this->mDB [$player] = $m;
		$this->save ();
	}
	public function seemoney($player) {
		return $this->mDB [$player];
	}
	public function reducemoney(Player $player, $m) {
		$name = strtolower ( $player->getName () );
		$this->mDB [$name] -= $m;
		$this->save ();
	}
	public function addmoney(Player $player, $m) {
		$name = strtolower ( $player->getName () );
		$this->mDB [$name] += $m;
		$this->save ();
	}
	public static function getInstance() {
		return self::$instance;
	}
}
