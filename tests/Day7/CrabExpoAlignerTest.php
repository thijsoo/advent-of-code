<?php

namespace Day7;

use Thijsvanderheijden\Adventofcode\Day7\CrabExpoAligner;
use Thijsvanderheijden\Adventofcode\Day7\CrabHorizonalAligner;
use PHPUnit\Framework\TestCase;

class CrabExpoAlignerTest extends TestCase {

	/** @var CrabHorizonalAligner */
	private $sut;
	protected function setUp(): void {
		parent::setUp();

		$crabs = explode(',','16,1,2,0,4,2,7,1,2,14');
		$this->sut = new CrabExpoAligner($crabs);
	}

	public function testCalculateFuelCost() {

		$this->assertEquals(168,$this->sut->calculateFuel());
	}
}
