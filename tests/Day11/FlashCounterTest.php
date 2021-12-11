<?php

namespace Day11;

use Thijsvanderheijden\Adventofcode\Day11\FlashCounter;
use PHPUnit\Framework\TestCase;

class FlashCounterTest extends TestCase
{
    private $sut;
    protected function setUp(): void
    {
        parent::setUp();

        $grid = [
            '5483143223',
'2745854711',
'5264556173',
'6141336146',
'6357385478',
'4167524645',
'2176841721',
'6882881134',
'4846848554',
'5283751526',
        ];

        $this->sut = new FlashCounter($grid);
    }

    public function testStepThroughGrid()
    {
       $c =  $this->sut->stepThroughGrid();

       $this->assertEquals(1656,$c);
    }

    public function testStepTillSuperFlash()
    {
        $c =  $this->sut->stepTillSuperFlash();

        $this->assertEquals(195,$c);
    }
    public function testStep()
    {
        $this->sut->step();

        dd($this->sut->getGrid());
    }
}
