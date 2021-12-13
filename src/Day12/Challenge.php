<?php


namespace Thijsvanderheijden\Adventofcode\Day12;


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
		$g = new Graph($this->lines);
        dd($g->findTotalPaths());
	}
	public function solveSecond(  ) {
		dump('wowsecond');
	}
}