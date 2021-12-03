<?php


namespace Thijsvanderheijden\Adventofcode\Day3;


use Thijsvanderheijden\Adventofcode\Base\ChallengeBase;

class Challenge extends ChallengeBase {


	/**
	 * Day1Challenge constructor.
	 */
	public function __construct() {
		$this->relativePath = __DIR__;
		parent::__construct();
	}

	public function solveFirst() {

		$gRate = '';
		$eRate = '';
		$map   = [];

		for ( $i = 0; $i < 12; $i ++ ) {

			$map[ $i ]   = [];
			$map[ $i ][] = 0;
			$map[ $i ][] = 0;
			foreach ( $this->lines as $totalLine ) {
				if ( $totalLine[ $i ] == 1 ) {
					$map[ $i ][1] ++;
				} else {
					$map[ $i ][0] ++;
				}
			}
		}

		foreach ( $map as $m ) {
			if ( $m[0] > $m[1] ) {
				$gRate .= 0;
				$eRate .= 1;
			} else {
				$gRate .= 1;
				$eRate .= 0;
			}
		}
		$intg = bindec( $gRate );
		$inte = bindec( $eRate );
		dd( $intg * $inte );
	}

	public function solveSecond() {
		$solver = new RatingGenerator();
		$oxyBit = bindec( $solver->getOxyGenBit( $this->lines ) );
		$co2    = bindec( $solver->getCo2GenBit( $this->lines ) );
		dd( $oxyBit * $co2 );
	}
}