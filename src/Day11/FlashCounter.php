<?php

namespace Thijsvanderheijden\Adventofcode\Day11;

class FlashCounter
{

    private $grid;

    private $counter = 0;
    /**
     * @param $grid
     */
    public function __construct($grid)
    {
        foreach ($grid as $key => $value) {
            $values = str_split($value);
            $octos = [];
            foreach ($values as $v) {
                $octos[] = new Octopus((int)$v);
            }
            $grid[$key] = $octos;
        }
        $this->grid = $grid;
    }

    public function stepThroughGrid()
    {
        $n = 0;
        while ($n !== 100) {
            $this->step();
            $n++;
        }

        return $this->counter;

    }

    public function stepTillSuperFlash()
    {
        $n = 0;
        while (!$this->superFlash()) {
            $this->step();
            $n++;
        }

        return $n;
    }

    private function superFlash(){
        foreach ($this->grid as $columnValue) {
            /** @var Octopus $octopus */
            foreach ($columnValue as $octopus) {
                if ($octopus->getEnergy() !== 0) {
                    return false;
                }
            }
        }
        return true;
    }

    private function resetGrid()
    {
        foreach ($this->grid as $columnValue) {
            /** @var Octopus $octopus */
            foreach ($columnValue as $octopus) {
                if ($octopus->getHasFlashed()) {
                    $octopus->reset();
                }
            }
        }
    }


    public function step()
    {
        //add to to octo in this position.
        foreach ($this->grid as $columnValue) {
            /** @var Octopus $octopus */
            foreach ($columnValue as $octopus) {
                $octopus->addEnergy();
            }
        }
        foreach ($this->grid as $currentColumn => $columnValue) {
            /** @var Octopus $octopus */
            foreach ($columnValue as $currentRow => $octopus) {
                $this->subStep($currentColumn, $currentRow);
            }
        }

        /**
         * reset grid
         */
        $this->resetGrid();
    }

    public function subStep($startingColumn, $startingRow, $addValue = false)
    {
        //santiy check if isset
        /** @var Octopus $octopus */
        if(!isset($this->grid[$startingColumn]) || !isset($this->grid[$startingColumn][$startingRow])){
            return;
        }
        $octopus = $this->grid[$startingColumn][$startingRow];
        if ($addValue) {
            $octopus->addEnergy();
        }

        if ($octopus->shouldFlash()) {
            $octopus->flash();
            $this->counter++;
            $this->subStep($startingColumn - 1, $startingRow, true);
            $this->subStep($startingColumn + 1, $startingRow, true);
            $this->subStep($startingColumn, $startingRow - 1, true);
            $this->subStep($startingColumn, $startingRow + 1, true);
            $this->subStep($startingColumn + 1, $startingRow + 1, true);
            $this->subStep($startingColumn - 1, $startingRow - 1, true);
            $this->subStep($startingColumn + 1, $startingRow - 1, true);
            $this->subStep($startingColumn - 1, $startingRow + 1, true);


        }
    }

    /**
     * @return mixed
     */
    public function getGrid()
    {
        return $this->grid;
    }
}