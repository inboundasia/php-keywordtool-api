<?php

namespace InboundAsia\KeywordTool;

use InboundAsia\KeywordTool\KeywordVolume;

class KeywordVolumeResult
{
    /** @var string A keyword that the search volume data is provided for. */
    protected $string = '';

    /** @var float Google Ads Cost-Per-Click (CPC) for the keyword. */
    protected $cpc;

    /** @var float Google Ads competition metric for the keyword. */
    protected $cmp;

    /** @var integer Average monthly search volume for the last 12 months. */
    protected $volume;

    /** @var KeywordVolume[] */
    protected $volumes = [];

    public function __construct($data)
    {
        $this->string = $data->string;
        $this->cpc = $data->cpc;
        $this->cmp = $data->cmp;
        $this->volume = $data->volume;

        for ($i = 1; $i <= 12; $i++)
        {
            $volumeField = "m$i";
            $monthField = "m$i" . "_month";
            $yearField = "m$i" . "_year";
            $string = $data->string;
            $volume = $data->{$volumeField};
            $month = $data->{$monthField};
            $year = $data->{$yearField};
            $this->volumes[] = new KeywordVolume($string, $year, $month, $volume);
        }
    }

    /**
     * get average monthly search volume for the last 12 months.
     *
     * @return integer|null
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * keywords volumes
     *
     * @return KeywordVolume[]
     */
    public function getVolumes()
    {
        return $this->volumes;
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
     * getter for Google Ads Cost-Per-Click
     *
     * @return float|null
     */
    public function getCpc()
    {
        return $this->cpc;
    }

    /**
     * getter for Google Ads competition metric
     *
     * @return float|null
     */
    public function getCmp()
    {
        return $this->cmp;
    }
}
