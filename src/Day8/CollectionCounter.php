<?php

namespace Thijsvanderheijden\Adventofcode\Day8;

class CollectionCounter {

	private $lines;

	private $c = 0;
	/**
	 * @param array $lines
	 */
	public function __construct( array $lines ) {
		$this->lines = $lines;
	}


	public function countUniqueInstances(  ) {

		foreach ($this->lines as $line){
			$values = explode(' | ', $line)[1];
			 array_map( function ($lineValue){
				if(strlen($lineValue) == 4 || strlen($lineValue) == 2 || strlen($lineValue) == 7 || strlen($lineValue) == 3){
					return $this->c++;
				}
			}, explode(' ',$values));
		}
		return $this->c;
	}
}