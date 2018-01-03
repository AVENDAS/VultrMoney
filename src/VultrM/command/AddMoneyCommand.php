<?php

namespace VultrM\commands;

use pocketmine\command\CommandSender;
use VultrM\VultrM;

class AddMoneyCommand {
	public $owner;
	public function __construct(VultrM $owner) {
		$this->owner = $owner;
	}
	public function onCommand(CommandSender $player, string $label, array $args): bool {
		$name = strtolower ( $player->getName () );
		if (isset ( $this->owner->mDB [$args [0]] )) {
			if (is_numeric ( $args [1] )) {
				$this->owner->addmoney ( $player, $args [1] );
				$this->owner->msg ( $player, "{$args[0]}에게 돈을 {$args[1]}만큼 주었습니다." );
			} else {
				$this->owner->msg ( $player, "숫자만 입력이 가능합니다." );
			}
		} else {
			$this->owner->msg ( $player, "그런 플레이어는 접속한 기록이 없습니다." );
		}
		return true;
	}
}