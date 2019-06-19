<?php

namespace InboundAsia\KeywordTool;

use InboundAsia\KeywordTool\KeywordVolumeResult;

class GoogleKeywordSuggestionResult
{
    /** @var mixed google search volume results raw data */
    protected $data;

    /** @var KeywordVolumeResult[] */
    protected $results = [];

    public function __construct($data)
    {
        $this->data = $data;

        foreach ($data->results as $suggestions)
        {
            foreach ($suggestions as $suggestion)
            {
                $this->results[] = new KeywordVolumeResult($suggestion);
            }
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
