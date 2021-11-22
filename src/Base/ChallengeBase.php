<?php


namespace Thijsvanderheijden\Adventofcode\Base;


abstract class ChallengeBase {

	protected $lines = [];
	protected $relativePath = '';

	public function __construct() {
		$this->loadLines();
	}

	private function loadLines(){
		$handle = fopen($this->relativePath.'/input/input.txt','r');
		while(($line = fgets($handle)) !== false){
			$this->lines[] = trim( $line );
		}
		fclose($handle);
	}
}