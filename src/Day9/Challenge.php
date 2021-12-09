<?php


namespace Thijsvanderheijden\Adventofcode\Day9;


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
		$riskcal = new RiskCalculator($this->lines);
		$c = $riskcal->calcRisk();
		dd($c);
	}
	public function solveSecond(  ) {
		$riskcal = new RiskCalculator($this->lines);
		$calc = $riskcal->calc($riskcal->getAllCompleteBasins());
dd($calc);
	}
}