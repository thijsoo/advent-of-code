<?php

namespace Day9;

use Thijsvanderheijden\Adventofcode\Day9\Basin;
use Thijsvanderheijden\Adventofcode\Day9\RiskCalculator;
use PHPUnit\Framework\TestCase;

class RiskCalculatorTest extends TestCase {

	private $sut;

	protected function setUp(): void {
		parent::setUp();

		$this->sut = new RiskCalculator(['2199943210',
										 '3987894921',
										 '9856789892',
										 '8767896789',
										 '9899965678',]);

	}


	public function testCalcRisk() {

		$this->assertEquals(15,$this->sut->calcRisk());
	}

	public function testGetAllCompleteBasins(  ) {
		$basins = [];
		$b = new Basin(1);
		$b->addNumber(2);
		$b->addNumber(3);
		$basins[] = $b;
		$b = new Basin(0);
		$b->addNumber(1);
		$b->addNumber(2);
		$b->addNumber(3);
		$b->addNumber(4);
		$b->addNumber(4);
		$b->addNumber(2);
		$b->addNumber(1);
		$b->addNumber(2);

		$basins[] = $b;

		$b = new Basin(5);
		$b->addNumber(8);
		$b->addNumber(7);
		$b->addNumber(8);
		$b->addNumber(8);
		$b->addNumber(6);
		$b->addNumber(7);
		$b->addNumber(8);
		$b->addNumber(8);
		$b->addNumber(7);
		$b->addNumber(6);
		$b->addNumber(7);
		$b->addNumber(8);
		$b->addNumber(8);

		$basins[] = $b;
		$b = new Basin(5);
		$b->addNumber(6);
		$b->addNumber(6);
		$b->addNumber(7);
		$b->addNumber(8);
		$b->addNumber(6);
		$b->addNumber(7);
		$b->addNumber(8);
		$b->addNumber(8);

		$basins[] = $b;

		$this->assertEquals(1134,$this->sut->calc($this->sut->getAllCompleteBasins()));
	}


	public function testIsNotFoundYet(  ) {
		$foundCords = [];
		$foundCords[] = [ 'x' => 1, 'y' => 2 ];
		$foundCords[] = [ 'x' => 2, 'y' => 2 ];
		$foundCords[] = [ 'x' => 3, 'y' => 2 ];
		$foundCords[] = [ 'x' => 4, 'y' => 2 ];
		$foundCords[] = [ 'x' => 1, 'y' => 5 ];
		$foundCords[] = [ 'x' => 1, 'y' => 6 ];

		$this->assertTrue($this->sut->isNotFoundYet($foundCords,3,1));
		$this->assertFalse($this->sut->isNotFoundYet($foundCords,1,2));
	}
}
