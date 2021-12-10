<?php

namespace Thijsvanderheijden\Adventofcode\Day10;

class SyntaxChecker {

	private $lines;

	public const STARTERS = [ '[', '(', '{', '<' ];
	public const ENDERS = [ ']', ')', '}', '>' ];

	/**
	 * @param $line
	 */
	public function __construct( $lines ) {
		$this->lines = $lines;
	}


	public function getSyntaxScore() {

		$badValues = [];
		foreach ( $this->lines as $line ) {
			$values    = str_split( $line );
			$startList = [];
			foreach ( $values as $character ) {
				if ( in_array( $character, self::STARTERS ) ) {
					$startList[] = $character;
				}

				if ( in_array( $character, self::ENDERS ) ) {
					$found = false;
					$slist = $startList;
					krsort( $slist );

					foreach ( $slist as $key => $start ) {
						if ( $start == $this->getOpposite( $character ) ) {
							$found = true;
							unset( $startList[ $key ] );
							break;
						}
						if ( $start != $this->getOpposite( $character ) ) {
							break;
						}
					}
					if ( ! $found ) {
						$badValues[] = $this->calcScore( $character );
						break;
					}
				}

			}
		}

		return array_sum( $badValues );
	}

	public function getAllValidLines() {
		$good = [];
		foreach ( $this->lines as $line ) {
			$bad       = false;
			$values    = str_split( $line );
			$startList = [];
			foreach ( $values as $character ) {
				if ( in_array( $character, self::STARTERS ) ) {
					$startList[] = $character;
				}

				if ( in_array( $character, self::ENDERS ) ) {
					$found = false;
					$slist = $startList;
					krsort( $slist );

					foreach ( $slist as $key => $start ) {
						if ( $start == $this->getOpposite( $character ) ) {
							$found = true;
							unset( $startList[ $key ] );
							break;
						}
						if ( $start != $this->getOpposite( $character ) ) {
							break;
						}
					}
					if ( ! $found ) {
						$bad = true;
						break;
					}
				}
			}
			if ( ! $bad ) {
				$good[] = $line;
			}
		}

		return $good;
	}

	public function getCompletedScore() {
		$score = [];
		$lines = $this->getAllValidLines();
		foreach ( $lines as $line ) {
			$values    = str_split( $line );
			$startList = [];
			foreach ( $values as $character ) {
				if ( in_array( $character, self::STARTERS ) ) {
					$startList[] = $character;
				}

				if ( in_array( $character, self::ENDERS ) ) {
					$slist = $startList;
					krsort( $slist );
					foreach ( $slist as $key => $start ) {
						if ( $start == $this->getOpposite( $character ) ) {
							unset( $startList[ $key ] );
							break;
						}
					}
				}
			}
			krsort( $startList );

			$s = 0;
			foreach ( $startList as $append ) {
				$s *= 5;
				$s += $this->getSmallValue( $this->getCloser( $append ) );
			}
			$score[] = $s;
		}
		sort($score);
		$middleVal = floor((count($score) - 1) / 2);
		return $score[$middleVal];
	}

	private function calcScore( $value ) {
		switch ( $value ) {
			case ')':
				return 3;
			case ']':
				return 57;
			case '}':
				return 1197;
			case '>':
				return 25137;
			default:
				throw new \Exception( 'error' );
		}
	}

	private function getSmallValue( $value ) {
		switch ( $value ) {
			case ')':
				return 1;
			case ']':
				return 2;
			case '}':
				return 3;
			case '>':
				return 4;
			default:
				throw new \Exception( 'error' );
		}
	}

	private function getOpposite( $value ) {
		switch ( $value ) {
			case ')':
				return '(';
			case ']':
				return '[';
			case '}':
				return '{';
			case '>':
				return '<';
			default:
				throw new \Exception( 'error' );
		}
	}

	private function getCloser( $value ) {
		switch ( $value ) {
			case '(':
				return ')';
			case '[':
				return ']';
			case '{':
				return '}';
			case '<':
				return '>';
			default:
				throw new \Exception( 'error' );
		}
	}
}