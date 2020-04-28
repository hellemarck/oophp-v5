<?php

namespace Mh\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min = 1;
    private $max = 6;


        /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object, $val)
    {
        $object->addToSerie($val);
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }


    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }


    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $string = "";
        $round = $this->getSerie();

        // for ($i = $this->min; $i <= $this->max; $i++) {
        for ($i = $this->min; $i <= $this->max; $i++) {
            $string .= "\n" . $i . ": ";
            foreach ($round as $dice) {
                if ($dice == $i) {
                    $string .= "*";
                }
            }
        }
        return $string;
    }
}
