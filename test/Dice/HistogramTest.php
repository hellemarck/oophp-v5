<?php


namespace Mh\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for Dice/Game class.
 */
class HistogramTest extends TestCase
{
    /**
     * Testing the variabels of injectData method
     *
     */
    public function testInjectData()
    {
        $testDiceHisto = new DiceHistogram();
        $testHisto = new Histogram();

        $this->assertInstanceOf("\Mh\Dice\Histogram", $testHisto);
        $vals = 3;

        $testHisto->injectData($testDiceHisto, $vals);
        $this->assertEquals(1, $testDiceHisto->getHistogramMin());
        $this->assertEquals(6, $testDiceHisto->getHistogramMax());
        $this->assertIsArray($testDiceHisto->getHistogramSerie());
    }

    /**
     * Testing update of Histogram serie array
     * and returned histogram as expected string
     */
    public function testGetAsText()
    {
        $testHisto2 = new Histogram();
        $testDiceHisto2 = new DiceHistogram();
        $values = [2, 5, 4, 5];

        foreach ($values as $val) {
            $testHisto2->injectData($testDiceHisto2, $val);
        }

        $exp = "\n1: \n2: *\n3: \n4: *\n5: **\n6: ";
        $this->assertEquals($exp, $testHisto2->getAsText());
    }
}
