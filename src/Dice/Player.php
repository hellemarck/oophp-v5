<?php

namespace Mh\Dice;

class Player
{
    private $score = 0;
    private $roundscore = 0;
    public $lastroll = 0;

    public function score()
    {
        return $this->score;
    }

    public function roundscore()
    {
        return $this->roundscore;
    }

    public function save()
    {
        $this->score += $this->roundscore;
        $this->roundscore = 0;
    }

    public function roll()
    {
        $this->lastroll = rand(1, 6);

        if ($this->lastroll == 1) {
            $this->roundscore = 0;
        } else {
            $this->roundscore += $this->lastroll;
        }
        return $this->roundscore;
    }

    public function lastRoll()
    {
        return $this->lastroll;
    }

    public function cpuRoll()
    {
        $numberOfRolls = rand(1, 5);
        $counter = 0;
        $keepRolling = true;

        while ($counter < $numberOfRolls && $keepRolling) {
            $this->lastroll = rand(1, 6);

            if ($this->lastroll != 1) {
                $this->roundscore += $this->lastroll;
            } else {
                $this->roundscore = 0;
                $keepRolling = false;
            }
            $counter += 1;
        }
        $this->score += $this->roundscore;
        $this->roundscore = 0;
    }
}
