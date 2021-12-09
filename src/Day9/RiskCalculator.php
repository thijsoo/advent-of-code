<?php

namespace Thijsvanderheijden\Adventofcode\Day9;

class RiskCalculator {

	private $lines;

	private $cords = [];

	/**
	 * @param array $lines
	 */
	public function __construct( array $lines ) {
		$this->lines = $lines;
	}


	public function calcRisk() {
		$c      = 0;
		$basins = $this->getBasins();
		/** @var Basin $l */
		foreach ( $basins as $l ) {
			$c += $l->getStart() + 1;
		}

		return $c;
	}

	private function getBasins() {
		$rmax = count( str_split( $this->lines[0] ) );
		$cmax = count( $this->lines );
		foreach ( $this->lines as $column => $lineItem ) {
			$lineItem = str_split( $lineItem );
			foreach ( $lineItem as $row => $number ) {
				$lowest[] = new Basin( $number );
			}
		}

		return $lowest;
	}

	public function getAllCompleteBasins() {

		$basins = [];
		foreach ( $this->lines as $column => $lineItem ) {
			$lineItem = str_split( $lineItem );
			foreach ( $lineItem as $row => $number ) {
				if ( $this->isBasin( $lineItem, $column, $row, $number ) ) {
					$this->cords   = [];
					$this->cords[] = [ 'x' => $row, 'y' => $column ];

					$basin      = new Basin( (int) $number );
					$addToBasin = [];
					$toAdd      = $this->checkAroundNumber( $row, $column, $addToBasin );
					foreach ( $toAdd as $a ) {
						$basin->addNumber( (int) $a );
					}
					$basins[] = $basin;
				}
			}
		}

		return $basins;
	}

	private function checkAroundNumber( $currentRow, $currentColumn, $basin ): array {

		$rmax = count( str_split( $this->lines[0] ) );
		$cmax = count( $this->lines );


		if ( $currentRow > 0 && $this->lines[ $currentColumn ][ $currentRow - 1 ] != 9 && $this->isNotFoundYet( $currentRow - 1, $currentColumn ) ) {
			$this->cords[] = [ 'x' => $currentRow - 1, 'y' => $currentColumn ];
			$foundN        = $this->lines[ $currentColumn ][ $currentRow - 1 ];
			$basin[]       = $foundN;
			$basin         = $this->checkAroundNumber( $currentRow - 1, $currentColumn, $basin );
		}
		if ( $currentRow + 1 < $rmax && $this->lines[ $currentColumn ][ $currentRow + 1 ] != 9 && $this->isNotFoundYet( $currentRow + 1, $currentColumn ) ) {
			$this->cords[] = [ 'x' => $currentRow + 1, 'y' => $currentColumn ];
			$foundN        = $this->lines[ $currentColumn ][ $currentRow + 1 ];
			$basin[]       = $foundN;
			$basin         = $this->checkAroundNumber( $currentRow + 1, $currentColumn, $basin );

		}
		if ( $currentColumn > 0 && $this->lines[ $currentColumn - 1 ][ $currentRow ] != 9 && $this->isNotFoundYet( $currentRow, $currentColumn - 1 ) ) {
			$this->cords[] = [ 'x' => $currentRow, 'y' => $currentColumn - 1 ];
			$foundN        = $this->lines[ $currentColumn - 1 ][ $currentRow ];
			$basin[]       = $foundN;
			$basin         = $this->checkAroundNumber( $currentRow, $currentColumn - 1, $basin );

		}
		if ( $currentColumn + 1 < $cmax && $this->lines[ $currentColumn + 1 ][ $currentRow ] != 9 && $this->isNotFoundYet( $currentRow, $currentColumn + 1 ) ) {
			$this->cords[] = [ 'x' => $currentRow, 'y' => $currentColumn + 1 ];
			$foundN        = $this->lines[ $currentColumn + 1 ][ $currentRow ];
			$basin[]       = $foundN;

			$basin = $this->checkAroundNumber( $currentRow, $currentColumn + 1, $basin );

		}

		return $basin;
	}

	public function isNotFoundYet( $xToCheck, $yToCheck ) {
		foreach ( $this->cords as $foundCord ) {
			if ( $foundCord['x'] == $xToCheck && $foundCord['y'] == $yToCheck ) {
				return false;
			}
		}

		return true;
	}

	private function isBasin( $lineItem, $column, $row, $number ) {
		$rmax = count( str_split( $this->lines[0] ) );
		$cmax = count( $this->lines );
		if ( $row > 0 && $lineItem[ $row - 1 ] <= $number ) {
			return false;
		}
		if ( $row + 1 < $rmax && $lineItem[ $row + 1 ] <= $number ) {
			return false;
		}
		if ( $column > 0 && $this->lines[ $column - 1 ][ $row ] <= $number ) {
			return false;
		}
		if ( $column + 1 < $cmax && $this->lines[ $column + 1 ][ $row ] <= $number ) {
			return false;
		}

		return true;
	}

	public function calc( array $basins ) {
		$counts = [];
		foreach ($basins as $b){
			$counts[] = count($b->getRest());
		}
		rsort($counts);

		return $counts[0] * $counts[1] * $counts[2];
	}
}