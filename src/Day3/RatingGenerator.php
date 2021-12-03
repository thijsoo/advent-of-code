<?php

namespace Thijsvanderheijden\Adventofcode\Day3;

class RatingGenerator {

	public function getOxyGenBit( array $bits ): string {
		$bitAmounts = $this->countBitAmount($bits);
		return $this->calculateOxyArray($bits,$bitAmounts,0);
	}

	private function calculateOxyArray(array $bits, array $bitAmounts, int $index): string{
		if(count($bits) === 1){
			return $bits[0];
		}
		$bitToKeep =  $bitAmounts[$index][0] > $bitAmounts[$index][1] ? '0' : '1';
		$keep = [];

		foreach ($bits as $bit){
			if($bit[$index] === $bitToKeep){
				$keep[] = $bit;
			}
		}

		$index++;
		return $this->calculateOxyArray($keep,$this->countBitAmount($keep),$index );
	}
	public function getCo2GenBit( array $bits ): string {
		$bitAmounts = $this->countBitAmount($bits);
		return $this->calculateCo2Array($bits,$bitAmounts,0);
	}

	private function calculateCo2Array(array $bits, array $bitAmounts, int $index): string{
		if(count($bits) === 1){
			return $bits[0];
		}
		$bitToKeep =  $bitAmounts[$index][0] <= $bitAmounts[$index][1] ? '0' : '1';
		$keep = [];

		foreach ($bits as $bit){
			if($bit[$index] === $bitToKeep){
				$keep[] = $bit;
			}
		}

		$index++;
		return $this->calculateCo2Array($keep,$this->countBitAmount($keep),$index );
	}
	private function countBitAmount($bits): array {
		for($i = 0; $i <= 11; $i++){
			$map[ $i ] = [];
			$map[ $i ][] = 0;
			$map[ $i ][] = 0;
			foreach ( $bits as $bit ) {
				if ( $bit[$i] == 1 ) {
					$map[ $i ][1] ++;
				} else {
					$map[ $i ][0] ++;
				}
			}
		}
		return $map;
	}
}