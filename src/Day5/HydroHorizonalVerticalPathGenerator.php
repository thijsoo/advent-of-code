<?php

namespace Thijsvanderheijden\Adventofcode\Day5;

class HydroHorizonalVerticalPathGenerator {


	/** @var array $input */
	private $input;

	/**
	 * @param array $input
	 */
	public function __construct( array $input ) {
		$this->input = $this->sanitzeInput($input);
	}
	private function sanitzeInput($lines){
		$good= [];
		foreach ($lines as $line) {
			$exploded = explode( ' -> ', $line );
			$start    = explode( ',', $exploded[0] );
			$end      = explode( ',', $exploded[1] );

			if($start[0] == $end[0] || $start[1] == $end[1]){
				$formattedLine = [];
				$formattedLine[0] = $start;
				$formattedLine[1] = $end;
				$good[] = $formattedLine;
			}
		}
		return $good;
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
			$start = $values[0][0];
			for($i = $startEnd['start']; $i <= $startEnd['end']; $i++){
				$allSteps[] = $start.','.$i;
			}
		}


		if ( $values[0][1] === $values[1][1] ) {

			$startEnd = $this->determineStartEndPoints( $values[0][0], $values[1][0] );

			$start = $values[0][1];
			for($i = $startEnd['start']; $i <= $startEnd['end']; $i++){
				$allSteps[] = $i. ','.$start;
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

}