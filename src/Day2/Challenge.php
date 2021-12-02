<?php


namespace Thijsvanderheijden\Adventofcode\Day2;


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
		$depth = 0;
		$horizontal = 0;

		foreach ($this->lines as $line){
			$split = explode(' ', $line);
			$command = $split[0];
			$value = $split[1];
			switch($command){
				case 'forward':
					$horizontal += $value;
					break;
				case 'down':
					$depth += $value;
					break;
				case 'up':
					$depth -= $value;
					break;
			}
		}



		dd($horizontal * $depth);
	}
	public function solveSecond(  ) {
		$depth = 0;
		$horizontal = 0;
		$aim = 0;

		foreach ($this->lines as $line){
			$split = explode(' ', $line);
			$command = $split[0];
			$value = $split[1];
			switch($command){
				case 'forward':
					$horizontal += $value;
					$depth += ($aim * $value);
					break;
				case 'down':
					$aim += $value;
					break;
				case 'up':
					$aim -= $value;
					break;
			}
		}



		dd($horizontal * $depth);
	}
}