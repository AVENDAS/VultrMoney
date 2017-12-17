<?php

namespace VultrM\event;

use VultrM\Main;

class SetMoneyEvent {
	private $owner, $name, $amount;
	public function __construct(Main $owner, $name, $amount) {
		parent::__construct ( $onwer );
		$this->name = $name;
		$this->amount = $amount;
	}
	public function getPlyerNmae() {
		return $this->name;
	}
	public function getAmount() {
		return $this->amount;
	}
}