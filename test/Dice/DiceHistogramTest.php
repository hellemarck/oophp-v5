<?php


namespace Mh\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for Dice/Game class.
 */
class DiceHistogramTest extends TestCase
{
    /**
     * Testing the returnvalue of max variable to be an int
     *
     */
    public function testGetHistogramMax()
    {
        $testHisto = new DiceHistogram();
        $this->assertInstanceOf("\Mh\Dice\DiceHistogram", $testHisto);

        $test = $testHisto->getHistogramMax();
        $this->assertisNumeric($test);
    }
}
