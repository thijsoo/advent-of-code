<?php

namespace Day6;

use Thijsvanderheijden\Adventofcode\Day6\LanternFishSpawner;
use PHPUnit\Framework\TestCase;

class LanternFishSpawnerTest extends TestCase {

	private $sut;
	protected function setUp(): void {
		parent::setUp();

		$this->sut = new LanternFishSpawner('3,4,3,1,2');
	}

	public function testCountFish(  ) {

		$this->assertEquals(26984457539,$this->sut->countFish());
	}


}
