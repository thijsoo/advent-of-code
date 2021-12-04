<?php

namespace Day4;

use PHPUnit\Framework\TestCase;
use Thijsvanderheijden\Adventofcode\Day4\Grid;

class BingoSolverTest extends TestCase {
	private $grid;

	protected function setUp(): void {
		parent::setUp();

		$gridInput1  = [
			'22', '13', '17', '11',  '0',
			'8', '2', '23', '4', '24',
			'21', '9', '14', '16', '7',
			'6', '10', '3', '18', '5',
			'1', '12', '20', '15', '19',
		];
		$ginput2 =['3',
			'15',
			'0',
			'2',
			'22',
			'9',
			'18',
			'13',
			'17',
			'5',
			'19',
			'8',
			'7',
			'25',
			'23',
			'20',
			'11',
			'10',
			'24',
			'4',
			'14',
			'21',
			'16',
			'12',
			'6',];
		$ginput3= ['14',
			'21',
			'17',
			'24',
			'4',
			'10',
			'16',
			'15',
			'9',
			'19',
			'18',
			'8',
			'23',
			'26',
			'20',
			'22',
			'11',
			'13',
			'6',
			'5',
			'2',
			'0',
			'12',
			'3',
			'7'];
		$this->grid[] = new Grid();
		$this->grid[] = new Grid();
		$this->grid[] = new Grid();


		foreach ($gridInput1 as $i) {
			$this->grid[0]->addNumberToGrid( $i );
		}
		foreach ($ginput2 as $i) {
			$this->grid[1]->addNumberToGrid( $i );
		}
		foreach ($ginput3 as $i) {
			$this->grid[2]->addNumberToGrid( $i );
		}

	}
	private function findBingo(){
		$input       = explode(',','7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1');

		foreach ( $input as $inputForBingo ) {
			/** @var Grid $grid */
			foreach ( $this->grid as $grid ) {
				$grid->markNumber( $inputForBingo );
				if ( $grid->hasBingo() ) {
					return $grid;
				}
			}
		}
	}


	public function testBingo() {

		$c = 0;
		$theGrid = $this->findBingo();
		foreach ( $theGrid->getGridArray() as $grid ) {
			foreach ( $grid as $gridItem ) {
				if ( ! $gridItem->isMarked() ) {
					$c += $gridItem->getNumber();
				}
			}
		}
		self::assertSame( 4512, $c * $theGrid->getCurInput() );
	}
}
