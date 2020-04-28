<?php


namespace Mh\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for Dice/Player class.
 */
class DiceCasePlayer extends TestCase
{
    /**
     * Testing the return of score-value.
     */
    public function testScoreReturned()
    {
        $player = new Player();
        $this->assertInstanceOf("\Mh\Dice\Player", $player);
        // assert att klassen är den förväntade

        $res = $player->score();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Testing the return of roundscore-value.
     */
    public function testRoundScoreReturned()
    {
        $player2 = new Player();
        $this->assertInstanceOf("\Mh\Dice\Player", $player2);
        // assert att klassen är den förväntade

        $res2 = $player2->roundscore();
        $exp2 = 0;
        $this->assertEquals($exp2, $res2);
    }

    /**
     * Testing the roll method in Player class.
     * as the return value of roll, lastroll and roundscore
     * is the same it's a success
     */
    public function testRoll()
    {
        $player3 = new Player();
        $this->assertInstanceOf("\Mh\Dice\Player", $player3);

        $roll = $player3->roll();
        $exp3 = $player3->lastRoll();
        $this->assertEquals($exp3, $roll);

        $exp4 = $player3->roundscore();
        $this->assertEquals($exp4, $roll);
    }

    /**
     * Testing the save method
     * Saving the score for one round in total score variable.
     */
    public function testSaveScore()
    {
        $usr = new Player();

        $roll2 = $usr->roll();
        $usr->save();
        $expected = 0;
        $check = $usr->roundscore();
        // expects roundscore to be 0 when saved and score to be rolled value
        $this->assertEquals($expected, $check);
        $this->assertEquals($roll2, $usr->score());
    }

    /**
     * Testing the cpu roll method
     * checking last roll to hold valid value
     */
    public function testCpuRoll()
    {
        $cpu = new Player();
        $cpu->cpuRoll(5);

        $lastRoll = $cpu->lastRoll();
        $this->assertThat(
            $lastRoll,
            $this->logicalAnd(
                $this->greaterThan(0),
                $this->lessThan(7)
            )
        );
    }
}
