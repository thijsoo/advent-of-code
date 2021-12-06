<?php

namespace Thijsvanderheijden\Adventofcode\Day6;

class LanternFishSpawner {

	private $inputArray;

	/**
	 * @param array $inputArray
	 */
	public function __construct( string $input ) {
		$this->inputArray = explode(',',$input);
	}


	public function countFish(  ) {
		$day = 0;
		$fishArray = [
			-1 => 0,
			0 => 0,
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0,
			6 => 0,
			7 => 0,
		];
		foreach ($this->inputArray as $fish){
			$fishArray[$fish]++;
		}

		while ($day !== 256){
			$newList = [];

			$newList[7] = $fishArray[8];
			$newList[6] = $fishArray[7];
			$newList[5] = $fishArray[6];
			$newList[4] = $fishArray[5];

			$newList[3] = $fishArray[4];

			$newList[2] = $fishArray[3];
			$newList[1] = $fishArray[2];
			$newList[0] = $fishArray[1];
			$newList[-1] = $fishArray[0];

			if($newList[-1] !== 0) {
				$newList[6] += $newList[-1];
				$newList[8] += $newList[-1];
				$newList[-1] = 0;
			}
			$fishArray = $newList;
			$day++;
		}
		$c = 0;
		foreach ($fishArray as $fish){
			$c+=$fish;
		}
		return $c;
	}
}