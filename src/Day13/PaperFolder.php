<?php

namespace Thijsvanderheijden\Adventofcode\Day13;

class PaperFolder
{

    private $matrixInput;
    private $directions;

    private $matrix;

    /**
     * @param array $lines
     */
    public function __construct(array $lines)
    {
        foreach ($lines as $line) {
            if ($line !== '' && $line[0] == 'f' ) {
                $direction = [];
                $input = explode('=', $line);
                $direction['position'] = $input[1];
                $input = explode(' ', $input[0]);
                $direction['direction'] = $input[2];
                $this->directions[] = $direction;
            } else {
                if ($line !== '') {
                    $this->matrixInput[] = $line;
                }
            }
        }
    }

    public function createMatrix()
    {
        $highY = 0;
        $highX = 0;
        $marks = [];
        foreach ($this->matrixInput as $key => $matrixInput) {
            $matrixInput = explode(',', $matrixInput);
            if ($matrixInput[0] > $highX) {
                $highX = $matrixInput[0];
            }
            $marks[$key]['x'] = $matrixInput[0];
            if ($matrixInput[1] > $highY) {
                $highY = $matrixInput[1];
            }
            $marks[$key]['y'] = $matrixInput[1];

        }
        for ($y = 0; $y <= 894; $y++) {
            if (!isset($this->matrix[$y])) {
                $this->matrix[$y] = [];
            }
            for ($x = 0; $x <= 1310; $x++) {
                if ($this->isMark($x, $y, $marks)) {
                    $this->matrix[$y][$x] = '#';
                } else {
                    $this->matrix[$y][$x] = ' ';
                }
            }
        }
    }

    private function isMark($x, $y, $marks)
    {
        foreach ($marks as $mark) {
            if ($mark['x'] == $x && $mark['y'] == $y) {
                return true;
            }
        }
        return false;
    }

    public function fold($direction, $position)
    {
        //find fold location
        $beforeFold = [];
        $afterFold = [];
        if($direction === 'y'){
            foreach ($this->matrix as $key => $m){
                if($key < $position){
                    $beforeFold[] = $m;
                }elseif ($key > $position){
                    $afterFold[] = $m;
                }
            }

            $afterFoldFLipped = array_reverse($afterFold);

            for ($y = 0; $y < count($beforeFold); $y++) {
                for ($x = 0; $x < count($beforeFold[$y]); $x++) {
                    if ($this->hasMarkOn($afterFoldFLipped[$y][$x])) {
                        $beforeFold[$y][$x] = '#';
                    }
                }
            }
        }
        if($direction === 'x'){
            foreach ($this->matrix as $key => $y){
                foreach ($y as $xKey => $x) {
                    if ($xKey < $position) {
                        $beforeFold[$key][$xKey] = $x;
                    } elseif ($xKey > $position) {
                        $afterFold[$key][$xKey] = $x;
                    }
                }
            }
            $afterFoldFLipped = [];
            foreach ($afterFold as $a){
                $afterFoldFLipped[] = array_reverse($a);
            }
            for ($y = 0; $y < count($beforeFold); $y++) {
                for ($x = 0; $x < count($beforeFold[$y]); $x++) {
                    if ($this->hasMarkOn($afterFoldFLipped[$y][$x])) {
                        $beforeFold[$y][$x] = '#';
                    }
                }
            }
        }
        $this->matrix = $beforeFold;
    }

    public function renderMatrix($matrix){
        foreach ($matrix as $key => $y){
            foreach ($y as $x){
                echo ' '.$x.' ';
            }
            echo PHP_EOL;
        }
    }
    private function hasMarkOn($markOptions){
            if ($markOptions == '#') {
                return true;
            }
        return false;
    }

    public function countMarks()
    {
        $c = 0;
        foreach ($this->matrix as $matrixY){
            foreach ($matrixY as $matrixX){
                if($matrixX == '#'){
                    $c++;
                }
            }
        }
        return $c;
    }

    /**
     * @return mixed
     */
    public function getMatrix()
    {
        return $this->matrix;
    }

    /**
     * @return array
     */
    public function getDirections(): array
    {
        return $this->directions;
    }




}