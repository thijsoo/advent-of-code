<?php

namespace Thijsvanderheijden\Adventofcode\Day5;

class HydroPathMap {

	private $map = [];

	public function hasValue( string $value ): bool {
		return array_key_exists( $value, $this->map );
	}

	public function setValue( string $value ): array {
		$this->map[ $value ] = 1;

		return $this->map;
	}

	public function addValue( string $value ): array {
		$this->map[ $value ] ++;

		return $this->map;
	}

	public function getValue( string $value ): string {
		return $this->map[ $value ];
	}

	public function getAmountOfMultiples(  ): int {
		$c = 0;
		foreach ($this->map as $row){
			if($row !== 1){
				$c++;
			}
		}
		return $c;
	}

	public function getMap(  ) {
		return $this->map;
	}

}