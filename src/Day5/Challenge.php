<?php


namespace Thijsvanderheijden\Adventofcode\Day5;

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
		$generator = new HydroHorizonalVerticalPathGenerator($this->lines);
		$map = $generator->generatePath();
		dd($map->getAmountOfMultiples());
	}
	public function solveSecond(  ) {
		$generator = new HydroHorizonalVerticalDiagonalPathGenerator();
		$generator->setInput($this->lines);
		$map = $generator->generatePath();
		dd($map->getAmountOfMultiples());
	}
}