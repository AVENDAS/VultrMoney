<?php

namespace VultrM\event;

use VultrM\Main;

class MyMoneyEvent {
	private $owner, $name;
	public function __construct(Main $owner, $name) {
		parent::__construct ( $onwer );
		$this->name = $name;
	}
	public function getPlayerName() {
		return $this->name;
	}
}