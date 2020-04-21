<?php

namespace Mh\Dice;

class Game
{
    public $player;
    public $cpu;
    public $turn;

    public function __construct()
    {
        $this->player = new Player();
        $this->cpu = new Player();
        $this->turn = "player";
    }

    public function player()
    {
        return $this->player;
    }

    public function changePlayer()
    {
        if ($this->turn == "player") {
            return $this->turn = "cpu";
        } else {
            return $this->turn = "player";
        }
    }

    public function winner($playerScore, $cpuScore)
    {
        if ($playerScore >= 100) {
            return [true, "player"];
        } else if ($cpuScore >= 100) {
            return [true, "cpu"];
        } else {
            return false;
        }
    }
}
