<?php


namespace Thijsvanderheijden\Adventofcode\Day6;


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
		$spawner = new LanternFishSpawner($this->lines[0]);
		$fish = $spawner->countFish();
		dd($fish);
	}
	public function solveSecond(  ) {
		dump('wowsecond');
	}
}