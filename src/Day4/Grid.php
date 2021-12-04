<?php

namespace Thijsvanderheijden\Adventofcode\Day4;

class Grid {

	private $gridArray = [
		[],
		[],
		[],
		[],
		[],
	];
	private $row = 0;
	private const MAX_LENGTH = 5;
	private $curInput;

	public function addNumberToGrid( int $number ) {

		$this->gridArray[ $this->row ][] = new BingoNumber( $number );

		if ( count( $this->gridArray[ $this->row ] ) === self::MAX_LENGTH ) {
			$this->row ++;
		}

	}

	public function markNumber( int $inputNumber ) {

		$this->curInput = $inputNumber;
		foreach ( $this->gridArray as $rowsValue ) {
			foreach($rowsValue as $bingoNumber) {
				if ( $bingoNumber->getNumber() === $inputNumber ) {
					$bingoNumber->mark();
				}
			}
		}
	}

	public function hasBingo(): bool {
		return ( $this->checkVertical() || $this->checkHorizonal()  );
	}

	private function checkHorizonal(): bool {
		foreach ( $this->gridArray as $rowsValue ) {
			$amountOfMarked = 0;
			foreach($rowsValue as $gridNumber){
				if ( $gridNumber->isMarked()  ) {
					$amountOfMarked ++;
					if($amountOfMarked === 5){
						return true;
					}
				}
			}
		}
		return false;
	}

	private function checkVertical(): bool {
		for ( $x = 0; $x < count($this->gridArray); $x++ ) {
			$amountOfMarked = 0;

			for($numbers = 0; $numbers < 5; $numbers++) {
				if ( $this->gridArray[$numbers][$x]->isMarked()  ) {
					$amountOfMarked ++;
					if($amountOfMarked === 5){
						return true;
					}
				}
			}
		}
		return false;
	}

	public function getGridArray(): array {
		return $this->gridArray;
	}

	/**
	 * @return mixed
	 */
	public function getCurInput() {
		return $this->curInput;
	}

	public function displayClean(  ) {
		$grid = [[],[],[],[],[]];


		foreach ($this->gridArray as $key =>  $gridLine) {
			foreach ($gridLine as $g) {
				$s = '';
				if($g->isMarked()){
					$s .= '*';
				}
				$s .= $g->getNumber();
				$grid[ $key ][] = $s;
			}
		}
		dump($grid);
	}



}