<?php

namespace Day13;

use Thijsvanderheijden\Adventofcode\Day13\PaperFolder;
use PHPUnit\Framework\TestCase;

class PaperFolderTest extends TestCase
{
    private $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $input = [
            '6,10',
            '0,14',
            '9,10',
            '0,3',
            '10,4',
            '4,11',
            '6,0',
            '6,12',
            '4,1',
            '0,13',
            '10,12',
            '3,4',
            '3,0',
            '8,4',
            '1,10',
            '2,14',
            '8,10',
            '9,0',
            'fold along y = 7',
            'fold along x = 5',
        ];
        $this->sut = new PaperFolder($input);
    }

    public function testCreateMatrix()
    {
        $this->sut->createMatrix();
        $this->assertEquals(18, $this->sut->countMarks());

    }

    public function testFold()
    {
        $this->sut->createMatrix();
        $this->sut->fold('y', 7);
        $this->assertEquals(17, $this->sut->countMarks());

    }

    public function testFoldTwice()
    {
        $this->sut->createMatrix();
        $this->sut->fold('y', 7);
       // $this->assertEquals(17, $this->sut->countMarks());
        $this->sut->fold('x', 5);
       // $this->assertEquals(16, $this->sut->countMarks());
        $this->sut->renderMatrix($this->sut->getMatrix());
die;
    }
}
