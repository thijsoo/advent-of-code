<?php


namespace Thijsvanderheijden\Adventofcode\Day8;


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
		$c = new CollectionCounter($this->lines);
		dd($c->countUniqueInstances());
	}
	public function solveSecond(  ) {
		$c = 0;
		foreach ($this->lines as $line) {
			$decoder = new Decoder( $line );
			$decoder->createWiringMatrix();
			$c += $decoder->decodeAndCount();
		}


		dd($c);
	}
}