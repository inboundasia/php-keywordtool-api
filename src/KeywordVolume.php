<?php

namespace InboundAsia\KeywordTool;

class KeywordVolume
{
    /** @var string A keyword that the search volume data is provided for. */
    protected $string = '';

    /** @var integer The exact year for the "m1" to "m12" values. */
    protected $year;

    /** @var integer The exact month number for the "m1" to "m12" values. */
    protected $month;

    /** @var integer Average monthly search volume for the last 12 months. */
    protected $volume;

    /**
     * Constructor
     *
     * @param string $string
     * @param integer $year
     * @param integer $month
     * @param integer $volume
     */
    public function __construct($string, $year, $month, $volume)
    {
        $this->string = $string;
        $this->year = $year;
        $this->month = $month;
        $this->volume = $volume;
    }

    /**
     * Getter for keyword term string
     *
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * getter for The exact year for the "m1" to "m12" values.
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * getter for The exact month number for the "m1" to "m12" values.
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * getter for average monthly search volume for the last 12 months.
     *
     * @return integer|null
     */
    public function getVolume()
    {
        return $this->volume;
    }
}
