<?php


namespace Thijsvanderheijden\Adventofcode\Day10;


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
		$syntaxChecker = new SyntaxChecker($this->lines);
		dd($syntaxChecker->getSyntaxScore());
	}
	public function solveSecond(  ) {
		$syntaxChecker = new SyntaxChecker($this->lines);
		dd($syntaxChecker->getCompletedScore());
	}
}