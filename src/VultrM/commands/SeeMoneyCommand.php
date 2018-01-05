<?php

namespace VultrM\commands;

use pocketmine\command\CommandSender;
use VultrM\VultrM;

class SeeMoneyCommand {
	public $owner;
	public function __construct(VultrM $owner) {
		$this->owner = $owner;
	}
	public function onCommand(CommandSender $player, string $label, array $args): bool {
		$name = strtolower($player->getName());
		if (isset ( $this->owner->mDB [$name] )) {
			$this->owner->msg ( $player, "{$args[0]}님의 돈 : " . $this->owner->mymoney ( $args [0] ) );
		} else {
			$this->owner->msg ( $player, "그런 플레이어는 접속한 적이 없습니다." );
		}
		return true;
	}
}