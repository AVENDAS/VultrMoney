<?php

namespace VultrM\event;

use VultrM\Main;

class GetRankEvent {
	private $owner, $name;
	public function __construct(Main $onwer, $name) {
		parent::__construct ( $owner );
		$this->name = $name;
	}
	public function getPlayerName() {
		return $this->name;
	}
}