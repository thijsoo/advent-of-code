<?php

namespace Day11;

use Thijsvanderheijden\Adventofcode\Day11\Octopus;
use PHPUnit\Framework\TestCase;

class OctopusTest extends TestCase
{
    private $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new Octopus();
    }


    public function testReset()
    {
        $this->sut->flash();
        $this->sut->addEnergy();
        $this->assertEquals(1,$this->sut->getEnergy());
        $this->assertEquals(true,$this->sut->getHasFlashed());
        $this->sut->reset();
        $this->assertEquals(false,$this->sut->getHasFlashed());
    }

    public function testShouldFlash()
    {
        $this->addEnergyTenTimes();
        $this->assertEquals(10,$this->sut->getEnergy());
        $this->assertFalse($this->sut->getHasFlashed());
        $this->assertTrue($this->sut->shouldFlash());
    }
    public function testShouldNotFlashAfterFlash()
    {
        $this->addEnergyTenTimes();
        $this->assertEquals(10,$this->sut->getEnergy());
        $this->assertFalse($this->sut->getHasFlashed());
        $this->sut->flash();
        $this->assertEquals(0,$this->sut->getEnergy());
        $this->assertTrue($this->sut->getHasFlashed());
        $this->assertFalse($this->sut->shouldFlash());
    }

    private function addEnergyTenTimes(){
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
        $this->sut->addEnergy();
    }

    public function testFlash()
    {

    }
}
