<?php

namespace Thijsvanderheijden\Adventofcode\Day5;

class HydroHorizonalVerticalDiagonalPathGenerator {


	/** @var array $input */
	private $input;

	/**
	 * @param array $input
	 */
	public function __construct() {

	}

	public function setInput( $input ) {
		$this->input = $this->sanitzeInput( $input );
	}

	private function sanitzeInput( $lines ) {
		$good = [];
		foreach ( $lines as $line ) {
			$exploded = explode( ' -> ', $line );
			$start    = explode( ',', $exploded[0] );
			$end      = explode( ',', $exploded[1] );

			if ( $start[0] == $end[0] || $start[1] == $end[1] || $this->canGoDiagonal( $start, $end ) ) {
				$formattedLine    = [];
				$formattedLine[0] = $start;
				$formattedLine[1] = $end;
				$good[]           = $formattedLine;
			}
		}

		return $good;
	}

	public function canGoDiagonal( $startOrginial, $endOriginal ) {
		$can = false;

		$can = $this->canGoDownRight($can,$startOrginial,$endOriginal);
		$can = $this->canGoUpLeft($can,$startOrginial,$endOriginal);
		$can = $this->canGoDownLeft($can,$startOrginial,$endOriginal);
		$can = $this->canGoUpRight($can,$startOrginial,$endOriginal);
		return $can;
	}

	private function canGoUpRight( $can, $start, $end ): bool {
		while ( $start[1] > $end[1] ) {
			$start[0] ++;
			$start[1] --;
			if ( $start[0] == $end[0] && $start[1] == $end[1] ) {
				$can = true;
			}
		}
		return $can;
	}

	private function canGoUpLeft($can, $start, $end ): bool {
		while ( $start[0] > $end[0] ) {
			$start[0] --;
			$start[1] --;
			if ( $start[0] == $end[0] && $start[1] == $end[1] ) {
				$can = true;
			}
		}
		return $can;
	}

	private function canGoDownRight($can, $start, $end ): bool {
		while ( $start[0] < $end[0] ) {
			$start[0] ++;
			$start[1] ++;
			if ( $start[0] == $end[0] && $start[1] == $end[1] ) {
				$can = true;
			}
		}
		return $can;
	}

	private function canGoDownLeft( $can, $start, $end ): bool {
		while ( $start[1] < $end[1] ) {
			$start[0] --;
			$start[1] ++;
			if ( $start[0] == $end[0] && $start[1] == $end[1] ) {
				$can = true;
			}
		}
		return $can;
	}

	public function generatePath(): HydroPathMap {
		$map = new HydroPathMap();
		foreach ( $this->input as $pathValues ) {
			$pathSteps = $this->getPathSteps( $pathValues );
			foreach ( $pathSteps as $step ) {
				$map->hasValue( $step ) ? $map->addValue( $step ) : $map->setValue( $step );
			}
		}

		return $map;
	}

	private function getPathSteps( array $values ): array {
		$allSteps = [];

		if ( $values[0][0] === $values[1][0] ) {
			$startEnd = $this->determineStartEndPoints( $values[0][1], $values[1][1] );
			$start    = $values[0][0];
			for ( $i = $startEnd['start']; $i <= $startEnd['end']; $i ++ ) {
				$allSteps[] = $start . ',' . $i;
			}
		}
		if ( $values[0][1] === $values[1][1] ) {

			$startEnd = $this->determineStartEndPoints( $values[0][0], $values[1][0] );

			$start = $values[0][1];
			for ( $i = $startEnd['start']; $i <= $startEnd['end']; $i ++ ) {
				$allSteps[] = $i . ',' . $start;
			}
		}

		if($this->canGoDownLeft(false,$values[0],$values[1])){
			$dlStart = $values[0];
			$dlEnd = $values[1];
			while ( $dlStart[1] < $dlEnd[1] ) {
				$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
				$dlStart[0] --;
				$dlStart[1] ++;
				if ( $dlStart[0] == $dlEnd[0] && $dlStart[1] == $dlEnd[1] ) {
					$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
					break;
				}
			}
		}
		if($this->canGoDownRight(false,$values[0],$values[1])){
			$dlStart = $values[0];
			$dlEnd = $values[1];
			while ( $dlStart[0] < $dlEnd[0] ) {
				$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
				$dlStart[0] ++;
				$dlStart[1] ++;
				if ( $dlStart[0] == $dlEnd[0] && $dlStart[1] == $dlEnd[1] ) {
					$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
					break;
				}
			}
		}

		if($this->canGoUpLeft(false,$values[0],$values[1])){
			$dlStart = $values[0];
			$dlEnd = $values[1];

			while ( $dlStart[0] > $dlEnd[0] ) {
				$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
				$dlStart[0] --;
				$dlStart[1] --;
				if ( $dlStart[0] == $dlEnd[0] && $dlStart[1] == $dlEnd[1] ) {
					$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
					break;
				}
			}
		}
		if($this->canGoUpRight(false,$values[0],$values[1])){
			$dlStart = $values[0];
			$dlEnd = $values[1];

			while ( $dlStart[1] > $dlEnd[1] ) {
				$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
				$dlStart[0] ++;
				$dlStart[1] --;
				if ( $dlStart[0] == $dlEnd[0] && $dlStart[1] == $dlEnd[1] ) {
					$allSteps[] = $dlStart[0] . ',' . $dlStart[1];
					break;
				}
			}
		}




		return $allSteps;
	}

	private function determineStartEndPoints( $first, $second ) {
		if ( $first > $second ) {
			return [ 'start' => $second, 'end' => $first ];
		}

		return [ 'start' => $first, 'end' => $second ];

	}

	/**
	 * @return array
	 */
	public function getInput(): array {
		return $this->input;
	}


}