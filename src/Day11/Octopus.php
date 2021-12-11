<?php

namespace Thijsvanderheijden\Adventofcode\Day11;

class Octopus {

	private $energy = 0;

	private $hasFlashed = false;

    /**
     * @param int $energy
     */
    public function __construct(int $energy = 0)
    {
        $this->energy = $energy;
    }


    /**
     * @return mixed
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * @param mixed $energy
     */
    public function addEnergy(): void
    {
        ++$this->energy;
    }

    /**
     * @return mixed
     */
    public function getHasFlashed()
    {
        return $this->hasFlashed;
    }

    /**
     * @param mixed $hasFlashed
     */
    public function setHasFlashed($hasFlashed): void
    {
        $this->hasFlashed = $hasFlashed;
    }


    public function shouldFlash()
    {
        return $this->energy > 9 && !$this->hasFlashed;
	}

    public function flash()
    {
        $this->hasFlashed = true;
    }

    public function reset()
    {
        $this->energy = 0;
        $this->hasFlashed = false;
    }
}