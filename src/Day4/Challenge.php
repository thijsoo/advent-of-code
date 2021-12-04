<?php


namespace Thijsvanderheijden\Adventofcode\Day4;


use Thijsvanderheijden\Adventofcode\Base\ChallengeBase;

class Challenge extends ChallengeBase {


	/**
	 * Day1Challenge constructor.
	 */
	public function __construct() {
		$this->relativePath = __DIR__;
		parent::__construct();
	}

	public function solveFirst(  ) {
		$input = $this->lines[0];
		unset( $this->lines[0], $this->lines[1] );

		$bingoSolver = new BingoSolver($input,$this->lines);

		dd($bingoSolver->solve());
	}
	public function solveSecond(  ) {

			$input = $this->lines[0];
			unset( $this->lines[0], $this->lines[1] );

			$bingoSolver = new BingoSolver($input,$this->lines);

			dd($bingoSolver->solve2());

	}
}