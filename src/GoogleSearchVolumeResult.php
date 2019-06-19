<?php

namespace InboundAsia\KeywordTool;

use InboundAsia\KeywordTool\KeywordVolumeResult;

class GoogleSearchVolumeResult
{
    /** @var mixed google search volume results raw data */
    protected $data;

    /** @var KeywordVolumeResult[] */
    protected $results = [];

    public function __construct($data)
    {
        $this->data = $data;

        foreach ($data->results as $item)
        {
            $this->results[] = new KeywordVolumeResult($item);
        }
    }

    /**
     * return keywordtool raw json response
     *
     * @return object
     */
    public function getRaw()
    {
        return $this->data;
    }

    /**
     * return keyword volume array
     *
     * @return KeywordVolumeResult[]
     */
    public function getResults()
    {
        return $this->results;
    }
}
