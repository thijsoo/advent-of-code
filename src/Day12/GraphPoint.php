<?php

namespace Thijsvanderheijden\Adventofcode\Day12;

class GraphPoint
{
    /** @var string */
    private $name;
    /** @var array<GraphPoint> */
    private $connectedPoints;
    /** @var bool */
    private $wasChecked = false;

    private $timeCheck = 0;
    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * @param GraphPoint $graphPoint
     * @return void
     */
    public function addPoint(GraphPoint $graphPoint)
    {
        if (!isset($this->connectedPoints[$graphPoint->getName()])) {
            $this->connectedPoints[$graphPoint->getName()] = $graphPoint;
            $graphPoint->addPoint($this);
        }
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return GraphPoint[]
     */
    public function getConnectedPoints(): array
    {
        return $this->connectedPoints;
    }

    /**
     * @return void
     */
    public function check(): void
    {
        $this->wasChecked = true;
        $this->timeCheck++;
    }

    /**
     * @return void
     */
    public function reset(): void
    {
        $this->wasChecked = false;
        $this->timeCheck--;
    }

    /**
     * @return bool
     */
    public function canCheck($hasTwo,$curPath): bool
    {
        if($this->getName() == 'start'){
            return false;
        }
        if(ctype_upper($this->getName())) {
            return true;
        }
        if(!$hasTwo){
            return true;
        }

        if($hasTwo){
            foreach ($curPath as $p){
                if($p == $this->getName()) {
                    return false;
                }
            }
            return true;
        }

        return false ;
    }

    /**
     * @return int
     */
    public function getTimeCheck(): int
    {
        return $this->timeCheck;
    }


}