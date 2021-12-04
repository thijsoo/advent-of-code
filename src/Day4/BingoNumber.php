<?php

namespace Thijsvanderheijden\Adventofcode\Day4;

class BingoNumber {

	private $number;
	private $isMarked = false;

	/**
	 * @param $number
	 */
	public function __construct(int $number ) {
		$this->number = $number;
	}

	public function mark(  ) {
		$this->isMarked = true;
	}

	public function isMarked(  ): bool {
		return $this->isMarked;
	}

	public function getNumber(): int {
		return $this->number;
	}


}