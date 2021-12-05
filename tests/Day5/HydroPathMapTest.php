<?php

namespace Day5;

use Thijsvanderheijden\Adventofcode\Day5\HydroPathMap;
use PHPUnit\Framework\TestCase;

class HydroPathMapTest extends TestCase {

	/** @var HydroPathMap $sut */
	private $sut;
	protected function setUp():void {
		parent::setUp();

		$this->sut = new HydroPathMap();
	}
	public function testAddValue() {
		$this->sut->setValue(400);
		$this->sut->addValue(400);
		$this->assertEquals(2,$this->sut->getValue(400) );
	}

	public function testSetValue() {
		$this->sut->setValue(400);
		$this->assertEquals(true, $this->sut->hasValue(400));
	}

}
