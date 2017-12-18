<?php

namespace VultrM\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use VultrM\Main;

class MyMoneyCommand {
	private $owner;
	public $tag = "§c§l[VirturlM]§7§o";
	public function __construct(Main $owner) {
		parent::__construct ( $owner );
		$this->owner = $owner;
	}
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) {
		$name = strtolower ( $sender->getName () );
		$this->owner->message ( $sender, " 당신의 돈 :" . $this->owner->mDB [$name] ["money"] );
	}
}