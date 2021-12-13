<?php

namespace Day12;

use Thijsvanderheijden\Adventofcode\Day12\Graph;
use PHPUnit\Framework\TestCase;

class GraphTest extends TestCase
{

    private $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $input = [
            'start-A',
            'start-b',
            'A-c',
            'A-b',
            'b-d',
            'A-end',
            'b-end',
        ];
        $this->sut = new Graph($input);
    }


    public function testCreatePathGraph()
    {
        $this->sut->createPathGraph();

        dd($this->sut->getSimpleRep());
    }
    public function testFindTotalPaths()
    {
        $p = $this->sut->findTotalPaths();
        $this->assertEquals(36,$p);
    }
}
