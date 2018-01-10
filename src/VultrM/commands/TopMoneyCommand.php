<?php

namespace VultrM\commands;

use pocketmine\command\CommandSender;
use VultrM\VultrM;

class TopMoneyCommand {
	public $owner;
	public function __construct(VultrM $owner) {
		$this->owner = $owner;
	}
	public function onCommand(CommandSender $player, string $label, array $args): bool {
		if (! isset ( $args [0] ) or ! is_numeric ( $args [1] )) {
			$index = 1;
			$rank = $this->owner->mDB;
			arsort ( $rank );
			$count = 0;
			$rankindex = $index * 5 - 4;
			foreach ( $rank as $p => $s ) {
				if (++ $count >= ($index * 5 - 4) and $count <= ($index * 5)) {
					$player->sendMessage ( "-=-=-=-[VultrM]-=-=-=-" );
					$player->sendMessage ( "[" . $rankindex ++ . "위] {$p} : {$s}" );
				}
			}
			return true;
		}
		$name = strtolower ( $player->getName () );
		$index = $args [0];
		$rank = $this->owner->mDB;
		arsort ( $rank );
		$count = 0;
		$rankindex = $index * 5 - 4;
		foreach ( $rank as $p => $s ) {
			if (++ $count >= ($index * 5 - 4) and $count <= ($index * 5)) {
				$player->sendMessage ( "-=-=-=-[VultrM]-=-=-=-" );
				$player->sendMessage ( "[" . $rankindex ++ . "위] {$p} : {$s}" );
			}
		}
	}
}