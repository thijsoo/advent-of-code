<?php

namespace Day7;

use Thijsvanderheijden\Adventofcode\Day7\CrabHorizonalAligner;
use PHPUnit\Framework\TestCase;

class CrabHorizonalAlignerTest extends TestCase {

	/** @var CrabHorizonalAligner */
	private $sut;
	protected function setUp(): void {
		parent::setUp();

		$crabs = explode(',','16,1,2,0,4,2,7,1,2,14');
		$this->sut = new CrabHorizonalAligner($crabs);
	}


	public function testCalculateOptimalPosition() {

		$this->assertEquals(2,$this->sut->calculateOptimalPosition());
	}

	public function testCalculateFuelCost() {

		$this->assertEquals(37,$this->sut->calculateFuelCost($this->sut->calculateOptimalPosition()));
	}
}
