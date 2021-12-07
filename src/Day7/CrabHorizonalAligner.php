<?php

namespace Thijsvanderheijden\Adventofcode\Day7;

class CrabHorizonalAligner {

	private $crabs;

	/**
	 * @param $crabs
	 */
	public function __construct( $crabs ) {
		$this->crabs = $crabs;
	}

	public function calculateOptimalPosition(  ) :int {
		sort($this->crabs);
		$c = count($this->crabs);
		$a = $this->crabs[$c/2];
		$b = $this->crabs[($c/2)-1];
		$d = ($a + $b )/2 ;
		return $d;
	}

	public function calculateFuelCost($optimalPosition): int{
		$f = 0;
		foreach ($this->crabs as $crab){
				$f += abs($crab - $optimalPosition);
		}
		return $f;
	}

}