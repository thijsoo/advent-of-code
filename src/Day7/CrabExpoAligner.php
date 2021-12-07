<?php

namespace Thijsvanderheijden\Adventofcode\Day7;

class CrabExpoAligner {

	private $crabs;

	/**
	 * @param $crabs
	 */
	public function __construct( $crabs ) {
		$this->crabs = $crabs;
	}

	public function calculateFuel(  ) :int {
		$lowestFuel = PHP_INT_MAX;
		foreach (range(0,max($this->crabs),1) as $c){
			$cost = $this->calculateFuelCost((int) $c);
			if($cost < $lowestFuel){
				$lowestFuel = $cost;
			}
		}
		return $lowestFuel;
	}

	public function calculateFuelCost($optimalPosition): int{
		$f = 0;
		foreach ($this->crabs as $crab){
			$c = abs($crab - $optimalPosition);
			for($i = 0; $i <= $c; $i++){
				$f += $i;
			}
		}
		return $f;
	}

}