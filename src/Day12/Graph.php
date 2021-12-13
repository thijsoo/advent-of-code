<?php

namespace Thijsvanderheijden\Adventofcode\Day12;

class Graph
{
    private $points;

    private $pathOptions;

    private $foundPaths;
    private $hastwo = false;

    private $curPath = [];
    private $totalPaths = 0;

    private const END_POINT = 'end';

    /**
     * @param $pathOptions
     */
    public function __construct($pathOptions)
    {
        $this->points = [];
        $this->foundPaths = [];
        $this->pathOptions = $pathOptions;
    }

    public function createPathGraph()
    {
        foreach ($this->pathOptions as $pathOption) {
            $options = explode('-', $pathOption);
            $option1 = $this->points[$options[0]] ?? new GraphPoint($options[0]);
            $option2 = $this->points[$options[1]] ?? new GraphPoint($options[1]);
            $option1->addPoint($option2);

            if ($option1->getName() == 'start') {
                $option1->check();
            }
            $this->points[$option1->getName()] = $option1;
            $this->points[$option2->getName()] = $option2;
        }
    }

    public function findTotalPaths()
    {
        $this->createPathGraph();
        $this->traversePoint($this->points['start']);

        return $this->totalPaths;
    }

    public function traversePoint(GraphPoint $graphPoint)
    {

        if ($graphPoint->getName() == self::END_POINT) {
            $this->totalPaths++;
            $this->foundPaths[] = $this->curPath;

            return;
        }


        $graphPoint->check();
        foreach ($graphPoint->getConnectedPoints() as $point) {
            //add curpath to cancheck method to check if current point would be a double if there is already a double
            //if not cancheck true. If would be double false.
            if ($point->canCheck($this->hastwo,$this->curPath)) {
                $this->curPath[$point->getName().$point->getTimeCheck()] = $point->getName();
                if($this->hasDouble()){
                    $this->hastwo = true;
                }
                $this->traversePoint($point);

                unset($this->curPath[$point->getName().$point->getTimeCheck()]);
                if(!$this->hasDouble()){
                    $this->hastwo = false;
                }

            }
        }
        $graphPoint->reset();
    }

    private function hasDouble(){
        $counter= [];
        foreach ($this->curPath as $c){
            if(!ctype_upper($c)){$counter[$c]++;}
        }
        asort($counter);
        return end($counter) >= 2;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }


    public function getSimpleRep()
    {
        $s = [];
        $plain = [];
        foreach ($this->points as $point) {
            $plain[] = $point->getName();
            foreach ($point->getConnectedPoints() as $p) {
                $plain[] = $p->getName();
            }

            $s[] = implode('-', $plain);
            $plain = [];
        }

        return $s;
    }
}