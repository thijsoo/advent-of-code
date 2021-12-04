<?php

namespace Thijsvanderheijden\Adventofcode\Day4;

class BingoSolver {

	private $input;
	private $gridData;
	private $compiledGrids;
	private $curGrid;

	/**
	 * @param $input
	 * @param $gridData
	 */
	public function __construct( $input, $gridData ) {
		$this->input         = explode( ',', $input );
		$this->gridData      = $gridData;
		$this->curGrid       = new Grid();
		$this->compiledGrids = [];
	}

	public function solve(): int {
		$this->createGridMap();

		$bingoGrid = $this->findBingo();

		$bingoGrid->displayClean();
		$c = 0;
		foreach ( $bingoGrid->getGridArray() as $grid ) {
			/** @var BingoNumber $gridItem */
			foreach ( $grid as $gridItem ) {
				if ( ! $gridItem->isMarked() ) {
					$c += $gridItem->getNumber();
				}
			}
		}

		return $bingoGrid->getCurInput() * $c;

	}

	public function solve2(): int {
		$this->createGridMap();

		$bingoGrid = $this->findAllBingos();
		$bingoGrid = end($bingoGrid);
		$bingoGrid->displayClean();
		$c = 0;
		foreach ( $bingoGrid->getGridArray() as $grid ) {
			/** @var BingoNumber $gridItem */
			foreach ( $grid as $gridItem ) {
				if ( ! $gridItem->isMarked() ) {
					$c += $gridItem->getNumber();
				}
			}
		}

		return $bingoGrid->getCurInput() * $c;

	}

	private function findAllBingos(): array {
		$bingos = [];
		foreach ( $this->input as $inputForBingo ) {
			/** @var Grid $grid */
			foreach ( $this->compiledGrids as $key =>  $grid ) {

				$grid->markNumber( $inputForBingo );
				if ( $grid->hasBingo() ) {
					unset($this->compiledGrids[$key]);
					$bingos[] = $grid;
				}
			}
		}
		return $bingos;

		throw new \Exception( "error" );
	}

	private function createGridMap() {
		foreach ( $this->gridData as $line ) {
			if ( $line === "" ) {
				$this->compiledGrids[] = $this->curGrid;
				$this->curGrid         = new Grid();
				continue;
			}

			$gridEntries = explode( ' ', $line );

			foreach ( $gridEntries as $gridEntry ) {
				if ( $gridEntry !== "" ) {
					$this->curGrid->addNumberToGrid( $gridEntry );
				}
			}

		}
	}


	private function findBingo(): Grid {
		foreach ( $this->input as $inputForBingo ) {
			/** @var Grid $grid */
			foreach ( $this->compiledGrids as $grid ) {

				$grid->markNumber( $inputForBingo );
				if ( $grid->hasBingo() ) {
					return $grid;
				}
			}
		}

		throw new \Exception( "error" );
	}


}