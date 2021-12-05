<?php

namespace Day5;

use Thijsvanderheijden\Adventofcode\Day5\HydroHorizonalVerticalDiagonalPathGenerator;
use PHPUnit\Framework\TestCase;
use Thijsvanderheijden\Adventofcode\Day5\HydroPathMap;

class HydroHorizonalVerticalDiagonalPathGeneratorTest extends TestCase {

	private $sut;

	protected function setUp(): void {
		parent::setUp();


	}

	public function testDiagonalDownRight() {
		$start   = [];
		$start[] = 1;
		$start[] = 1;
		$end     = [];
		$end[]   = 3;
		$end[]   = 3;

		$this->sut = new HydroHorizonalVerticalDiagonalPathGenerator();
		$this->assertTrue( $this->sut->canGoDiagonal( $start, $end ) );
	}
	public function testDiagonalDownLeft() {
		$start   = [];
		$start[] = 9;
		$start[] = 7;
		$end     = [];
		$end[]   = 7;
		$end[]   = 9;

		$this->sut = new HydroHorizonalVerticalDiagonalPathGenerator();
		$this->assertTrue( $this->sut->canGoDiagonal( $start, $end ) );
	}
	public function testDiagonalUpLeft() {
		$start   = [];
		$start[] = 3;
		$start[] = 3;
		$end     = [];
		$end[]   = 1;
		$end[]   = 1;

		$this->sut = new HydroHorizonalVerticalDiagonalPathGenerator();
		$this->assertTrue( $this->sut->canGoDiagonal( $start, $end ) );
	}

	public function testDiagonalUpRight() {
		$start   = [];
		$start[] = 7;
		$start[] = 9;
		$end     = [];
		$end[]   = 9;
		$end[]   = 7;

		$this->sut = new HydroHorizonalVerticalDiagonalPathGenerator();
		$this->assertTrue( $this->sut->canGoDiagonal( $start, $end ) );
	}

	public function testSetinput() {
		$expected  = [
			[
				[
					0 => "9",
					1 => "7"
				],
				[
					0 => "7",
					1 => "9"
				]
			],
			[
				[
					0 => "1",
					1 => "1"
				],
				[
					0 => "3",
					1 => "3"
				]
			]
		];
		$input     = [ '9,7 -> 7,9', '1,1 -> 3,3', ];
		$this->sut = new HydroHorizonalVerticalDiagonalPathGenerator();

		$this->sut->setInput( $input );
		$this->assertEquals( $expected, $this->sut->getInput() );
	}

	public function testGeneratePath(  ) {
		$map = new HydroPathMap();
		$map->addValue('9,7');
		$map->addValue('8,8');
		$map->addValue('7,9');
		$map->addValue('1,1');
		$map->addValue('2,2');
		$map->addValue('3,3');
		$map->addValue('1,1');
		$map->addValue('1,2');
		$map->addValue('1,3');
		$map->addValue('3,3');
		$map->addValue('2,2');
		$map->addValue('1,1');
		$map->addValue('7,9');
		$map->addValue('8,8');
		$map->addValue('9,7');

		$input     = [ '9,7 -> 7,9', '1,1 -> 3,3','1,1 -> 1,3','3,3 -> 1,1', '7,9 -> 9,7' ];
		$this->sut = new HydroHorizonalVerticalDiagonalPathGenerator();

		$this->sut->setInput( $input );
		$this->assertEquals( $map->getMap(), $this->sut->generatePath()->getMap() );
	}
}
