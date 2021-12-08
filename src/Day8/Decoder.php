<?php

namespace Thijsvanderheijden\Adventofcode\Day8;

class Decoder {


	private $matrixInput;
	private $decodeData;

	private $c = 0;

	/**
	 * @param array $lines
	 */
	public function __construct( string $line ) {
		$input             = explode( ' | ', $line );
		$this->matrixInput = explode( ' ', $input[0] );
		usort( $this->matrixInput, function ( $a, $b ) {
			return strlen( $a ) - strlen( $b );
		} );
		$this->decodeData = explode( ' ', $input[1] );

		$this->matrix = [];
	}

	public function createWiringMatrix() {
		$this->matrix[1] = $this->matrixInput[0];
		$this->matrix[7] = $this->matrixInput[1];
		$this->matrix[8] = $this->matrixInput[9];
		$this->matrix[4] = $this->matrixInput[2];
		$this->matrix[0] = $this->determineZero( str_split( $this->matrix[1] ), str_split( $this->matrix[4] ), str_split( $this->matrixInput[6] ), str_split( $this->matrixInput[7] ), str_split( $this->matrixInput[8] ) );
		$this->matrix[9] = $this->determineNine( str_split( $this->matrix[1] ), str_split( $this->matrix[0] ), str_split( $this->matrixInput[6] ), str_split( $this->matrixInput[7] ), str_split( $this->matrixInput[8] ) );
		$this->matrix[6] = $this->determineSix( $this->matrix[0], $this->matrix[9], $this->matrixInput[6], $this->matrixInput[7], $this->matrixInput[8] );
		$this->matrix[2] = $this->determineTwo( str_split( $this->matrix[9] ), str_split( $this->matrixInput[3] ), str_split( $this->matrixInput[4] ), str_split( $this->matrixInput[5] ) );
		$this->matrix[5] = $this->determineFive( str_split( $this->matrix[2] ), str_split( $this->matrixInput[3] ), str_split( $this->matrixInput[4] ), str_split( $this->matrixInput[5] ) );
		$this->matrix[3] = $this->determineThree( str_split( $this->matrix[2] ), str_split( $this->matrix[5] ), str_split( $this->matrixInput[3] ), str_split( $this->matrixInput[4] ), str_split( $this->matrixInput[5] ) );
		ksort( $this->matrix );

		return $this->matrix;
	}

	public function decodeAndCount() {

		$c = '';
		foreach ( $this->decodeData as $decodeOption ) {
		//	dd($this->decodeData,$this->matrix);
			$decodeOption = str_split( $decodeOption );
			sort( $decodeOption );
			$decodeOption = implode( $decodeOption );
			foreach ( $this->matrix as $key => $value ) {
				$value = str_split( $value );
				sort( $value );
				$value = implode( $value );

				if ( $value == $decodeOption ) {
					$c .= $key;
					continue;
				}
			}
		}

		return $c;

	}

	/**
	 *   00000000
	 *  1        2
	 *  1        2
	 *  1        2
	 *  1        2
	 *   33333333
	 *  4        5
	 *  4        5
	 *  4        5
	 *  4        5
	 *   66666666
	 *
	 * 0 = 0,1,2,4,5,6
	 * 1 = 2,5
	 * 2 = 0,2,3,4,6
	 * 3 = 0,2,3,5,6
	 * 4 = 1,2,3,5
	 * 5 = 0,1,3,5,6
	 * 6 = 0,1,3,4,5,6
	 * 7 = 0,2,5
	 * 8 = 0,1,2,3,4,5,6
	 * 9 = 0,1,2,3,5,6
	 */
	private function determineZero( $one, $four, ...$letters ): string {
		$o      = [];
		$toFind = array_diff( $four, $one );
		foreach ( $letters as $option ) {
			foreach ( $option as $letter ) {
				if ( ! in_array( $letter, $toFind ) ) {
					$o[ implode( '', $option ) ] ++;
				}
			}
		}

		asort( $o );
		$a = array_keys( $o );

		return array_pop( $a );
	}

	private function determineNine( $one, $zero, ...$letters ): string {
		$o = [];
		foreach ( $letters as $option ) {
			foreach ( $option as $letter ) {
				if ( in_array( $letter, $one ) ) {
					$o[ implode( '', $option ) ] ++;
				}
			}
		}
		foreach ( $o as $key => $count ) {
			if ( $count == 2 && $key != implode('',$zero) ) {
				return $key;
			}
		}
	}


	private function determineSix( $zero, $nine, ...$letters ): string {
		$found   = [];
		$found[] = $zero;
		$found[] = $nine;
		foreach ( $letters as $f ) {
			if ( ! in_array( $f, $found ) ) {
				return $f;
			}
		}

	}

	private function determineThree( $two, $five, ...$letters ) {
		$found   = [];
		$found[] = $two;
		$found[] = $five;
		foreach ( $letters as $f ) {
			if ( ! in_array( $f, $found ) ) {
				return implode( '', $f );
			}
		}

	}

	private function determineFive( $two, ...$letters ): string {
		$o = [];
		foreach ( $letters as $option ) {
			foreach ( $option as $letter ) {
				if ( ! in_array( $letter, $two ) ) {
					$o[ implode( '', $option ) ] ++;
				}
			}
		}

		asort( $o );
		$a = array_keys( $o );

		return array_pop( $a );
	}

	private function determineTwo( $nine, ...$letters ) {
		$o = [];
		foreach ( $letters as $option ) {
			foreach ( $option as $letter ) {
				if ( in_array( $letter, $nine ) ) {
					$o[ implode( '', $option ) ] ++;
				}
			}
		}
		arsort( $o );
		$a = array_keys( $o );

		return array_pop( $a );
	}
}