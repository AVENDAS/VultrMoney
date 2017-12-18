<?php

namespace VultrM\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use VultrM\Main;

class PayMoneyCommand {
	private $owner;
	public $tag = "§c§l[VirturlM]§7§o";
	public function __construct(Main $owner) {
		parent::__construct ( $owner );
		$this->owner = $owner;
	}
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) {
		$arname = strtolower ( $args [0] );
		$money = $args [1];
		if (! isset ( $this->owner->mDB [$arname] )) {
			$this->owner->message ( $sender, " 그런플레이어는 접속한 적이 없습니다." );
		} else {
			$this->owner->mDB [$arname] ["money"] += $money;
			$name = strtolower ( $sender->getName () );
			$this->owner->mDB [$name] ["money"] -= $money;
			$this->owner->message ( $sender, "{$arname}님에게 돈을 $money 만큼 주었습니다. " );
			$this->owner->message ( $arname, "{$sender}님으로부터 돈을 $money 만큼 받았습니다." );
			$this->owner->ConfigSave ();
		}
	}
}