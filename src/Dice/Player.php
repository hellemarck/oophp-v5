<?php

namespace Mh\Dice;

class Player
{
    private $score = 0;
    private $roundscore = 0;
    public $lastroll = 0;
    // public $histogram;
    // public $diceHistogram;

    // public $diceHistogram = new DiceHistogram();
    // public $histogram = new Histogram();

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
        // $this->histogram->injectData($this->diceHistogram, $this->lastroll());
        return $this->roundscore;
    }

    public function lastRoll()
    {
        return $this->lastroll;
    }

    public function cpuRoll($pScore)
    {
        $numberOfRolls = $this->cpuNumOfRolls($pScore, $this->score); //rand(1, 5);
        $counter = 0;
        $keepRolling = true;
        $values = [];

        while ($counter < $numberOfRolls && $keepRolling) {
            $this->lastroll = rand(1, 6);
            array_push($values, $this->lastroll);

            if ($this->lastroll != 1) {
                $this->roundscore += $this->lastroll;
            } else {
                $this->roundscore = 0;
                $keepRolling = false;
            }
            $counter += 1;
            if ($this->roundscore > 20) {
                $keepRolling = false;
            }
        }
        $this->score += $this->roundscore;
        $this->roundscore = 0;
        return $values;
    }

    public function cpuNumOfRolls($pScore, $cScore)
    {
        $advantage = $cScore - $pScore;
        $disadvantage = $pScore - $cScore;

        if ($advantage >= 25 && $cScore > 60) {
            return rand(1, 3);
        } elseif ($disadvantage >= 10 && $pScore > 70) {
            return rand(4, 7);
        } else {
            return rand(3, 5);
        }
    }
}
