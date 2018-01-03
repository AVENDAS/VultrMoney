<?php

namespace VultrM\commands;

use pocketmine\command\CommandSender;
use VultrM\VultrM;

class TopMoneyCommand {
	public $owner;
	public function __construct(VultrM $owner) {
		$this->owner = $onwer;
	}
	public function onCommand(CommandSender $player, string $label, array $args): bool {
		$name = strtolower ( $player->getName () );
		$index = $args [0];
		$rank = $this->owner->mdb;
		arsort ( $rank );
		$count = 0;
		$rankindex = $index * 5 - 4;
		foreach ( $rank as $p => $s ) {
			if (++ $count >= ($index * 5 - 4) and $count <= ($index * 5)) {
				$this->owner->msg ( $player, "[" . $rankindex ++ . "위] {$p} : {$s}" );
			}
		}
	}
}