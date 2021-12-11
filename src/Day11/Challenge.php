<?php


namespace Thijsvanderheijden\Adventofcode\Day11;


use Thijsvanderheijden\Adventofcode\Base\ChallengeBase;

class Challenge extends ChallengeBase
{


    /**
     * Day1Challenge constructor.
     */
    public function __construct()
    {
        $this->relativePath = __DIR__;
        parent::__construct();
    }

    public function solveFirst()
    {
        $fc = new FlashCounter($this->lines);
        $c = $fc->stepThroughGrid();
        dd($c);
    }

    public function solveSecond()
    {
        $fc = new FlashCounter($this->lines);
        $c = $fc->stepTillSuperFlash();
        dd($c);
    }
}