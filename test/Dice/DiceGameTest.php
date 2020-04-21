<?php


namespace Mh\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for Dice/Game class.
 */
class DiceCaseGame extends TestCase
{
    /**
     * Testing to change what players turn it is
     * from player to cpu and back
     */
    public function testChangePlayer()
    {
        $testGame = new Game();
        $this->assertInstanceOf("\Mh\Dice\Game", $testGame);
        // assert att klassen är den förväntade

        $res = $testGame->changePlayer();
        $exp = "cpu";
        $this->assertEquals($res, $exp);

        $res2 = $testGame->changePlayer();
        $expChangeBack = "player";
        $this->assertEquals($res2, $expChangeBack);
    }

    /**
     * Testing return of player as winner
     */
    public function testWinnerPlayer()
    {
        $testGame2 = new Game();

        $reswinner = $testGame2->winner(101, 80);
        $exp = [true, "player"];
        $this->assertEquals($reswinner, $exp);
    }

    /**
     * Testing return of cpu as winner
     */
    public function testWinnerCpu()
    {
        $testGame3 = new Game();

        $resWinner = $testGame3->winner(80, 101);
        $expWinner = [true, "cpu"];
        $this->assertEquals($resWinner, $expWinner);
    }

    /**
     * Testing return of winner method when no player has won
     */
    public function testNoWinner()
    {
        $testGame4 = new Game();

        $resNoWinner = $testGame4->winner(40, 30);
        $expNoWinner = false;
        $this->assertEquals($resNoWinner, $expNoWinner);
    }
}
