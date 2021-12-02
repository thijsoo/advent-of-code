<?php


namespace Thijsvanderheijden\Adventofcode\Day1;


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
		$c = 0;
		$prevLine = null;
		foreach($this->lines as $line){
			$curLine = $line;
			if($prevLine !== null && $prevLine < $curLine){
				$c++;
			}
			$prevLine = $curLine;
		}
		dd($c);
	}
	public function solveSecond(  ) {
		$windowSums = [];
		$curSum = $this->lines[0] + $this->lines[1];
		$iMax = count( $this->lines );
		for ($i =2;  $i < $iMax; $i++){
			$curSum += $this->lines[$i];
				$windowSums[] = $curSum;
				$curSum -= $this->lines[$i-2];


		}
		$c = 0;
		$prevLine = null;
		foreach($windowSums as $line){
			$curLine = $line;
			if($prevLine !== null && $prevLine < $curLine){
				$c++;
			}
			$prevLine = $curLine;
		}


		dd($c);
	}
}