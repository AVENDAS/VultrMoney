<?php

namespace VultrM\commands;

use pocketmine\command\CommandSender;
use VultrM\VultrM;

class ReduceMoneyCommand {
	public $owner;
	public function __construct(VultrM $owner) {
		$this->owner = $owner;
	}
	public function onCommand(CommandSender $sender, string $label, array $args): bool {
		if (! isset ( $args [0] ) or ! is_numeric ( $args [1] )) {
			$this->owner->msg ( $player, "다시 입력하세요," );
			return true;
		}
		if (isset ( $this->owner->mDB [$args [0]] )) {
			if (is_numeric ( $args [1] )) {
				if ($this->owner->mymoney ( $args [0] > $args [1] )) {
					$this->owner->reducemoney ( $player, $args [1] );
					$this->owner->msg ( $player, "{$args[0]}에게서 돈을  {$args[1]}만큼 뺏었습니다." );
				} else {
					$this->owner->msg ( $player, "그 플레이어의 돈이 충분하지 않습니다." );
				}
			} else {
				$this->owner->msg ( $player, "숫자만 입력이 가능합니다." );
			}
		} else {
			$this->owner->msg ( $player, "그런 플레이어는 접속한 기록이 없습니다." );
		}
	}
}