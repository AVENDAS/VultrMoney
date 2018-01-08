<?php

namespace VultrM\commands;

use pocketmine\command\CommandSender;
use VultrM\VultrM;
use pocketmine\Player;

class SetMoneyCommand {
	public $owner;
	public function __construct(VultrM $owner) {
		$this->owner = $owner;
	}
	public function onCommand(CommandSender $player, string $label, array $args): bool {
		if (! isset ( $args [0] ) or ! is_numeric ( $args [1] )) {
			$this->owner->msg ( $player, "다시 입력하세요," );
			return true;
		}
		$target = $this->owner->getServer ()->getPlayer ( $args [0] );
		if ($target instanceof Player) {
			if (isset ( $this->owner->mDB [$target] )) {
				$this->owner->setmoney ( $target, $args [1] );
			} else {
				$this->owner->msg ( $player, "그런 플레이어는 접속한 기록이 없습니다." );
			}
		}
	}
}