<?php

namespace InboundAsia\KeywordTool;

use InboundAsia\KeywordTool\GoogleSearchVolumeResult;
use InboundAsia\KeywordTool\GoogleKeywordSuggestionResult;

class KeywordTool
{
    const QuotaEndpoint = 'https://api.keywordtool.io/v2/quota';
    const GoogleSearchVolumeEndpoint = 'https://api.keywordtool.io/v2/search/volume/google';
    const GoogleKeywordSuggestionEndpoint = 'https://api.keywordtool.io/v2/search/suggestions/google';
    const GoogleAnalyzeCompetitorsEndpoint = 'https://api.keywordtool.io/v2/search/analyze-competitors/google';

    /** @var string */
    private $apikey;

    /**
     * Constructor
     *
     * @param string $apikey
     */
    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;
    }

    /**
     * Check for API usage and quota
     *
     * {
     *   "limits": {
     *     "minute": {
     *       "quota": 10,
     *       "used": 2,
     *       "remaining": 8
     *     },
     *     "daily": {
     *       "quota": 800,
     *       "used": 128,
     *       "remaining": 672
     *     }
     *   }
     * }
     * @return void
     */
    public function quota()
    {
        $params = [
            'apikey' => $this->apikey,
          ];

          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, self::QuotaEndpoint);
          curl_setopt($ch, CURLOPT_POST, TRUE);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          $output = curl_exec($ch);
          $response = json_decode($output);

          return $response;
    }

    /**
     * Get precise Google search volume data for keywords
     *
     * {
     *  "results": {
     *     "keyword1": {
     *         "string": "keyword1",
     *         "volume": 10000,
     *         "m1": 15000,
     *         "m1_month": 6,
     *         "m1_year": 2018,
     *         "m2": 15000,
     *         "m2_month": 7,
     *         "m2_year": 2018,
     *         "cpc": 1.256,
     *         "cmp": 0.9984378137799302
     *     }
     *  }
     * }
     *
     * @param array $keywords 1 to 800 keywords are accepted
     * @return void
     */
    public function google_search_volume(array $keywords, array $options = [])
    {
        $params = [
            'apikey' => $this->apikey,
            'keyword' => $keywords,
            'metrics_location' => $options['metrics_location'] ?? '',
            'metrics_language' => $options['metrics_language'] ?? '',
            'metrics_network' => 'googlesearchnetwork',
            'metrics_currency' => 'USD',
            'output' => 'json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::GoogleSearchVolumeEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($ch);
        $response = json_decode($output);

        return new GoogleSearchVolumeResult($response);
    }

    /**
     * Keyword Suggestions API for Google
     *
     * {
     *   "results": {
     *     "": [
     *       {
     *         "string": "apple",
     *         "volume": 4090000,
     *         "m1": 3350000,
     *         "m1_month": 6,
     *         "m1_year": 2018,
     *         "m2": 3350000,
     *         "m2_month": 5,
     *         "m2_year": 2018
     *       }
     *     ],
     *     "apple": [
     *       {
     *         "string": "applebees",
     *         "volume": 2240000,
     *         "m1": null,
     *         "m1_month": 6,
     *         "m1_year": 2018,
     *         "m2": null,
     *         "m2_month": 5,
     *         "m2_year": 2018
     *       }
     *     ]
     *   }
     * }
     *
     * @param string $keyword
     * @return GoogleKeywordSuggestionResult
     */
    public function google_keyword_suggestions(string $keyword, array $options = [])
    {
        $params = [
          'apikey' => $this->apikey,
          'keyword' => $keyword,
          'country' => $options['country'] ?? 'US',
          'language' => $options['language'] ?? 'en',
          'type' => $options['type'] ?? 'suggestions',
          'category' => $options['category'] ?? 'web',
          'metrics' => 'true',
          'metrics_location' => $options['metrics_location'] ?? '',
          'metrics_language' => $options['metrics_language'] ?? '',
          'metrics_network' => 'googlesearchnetwork',
          'metrics_currency' => 'USD',
          'output' => 'json',
          'complete' => $options['complete'] ?? 'false'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::GoogleKeywordSuggestionEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($ch);
        $response = json_decode($output);

        return new GoogleKeywordSuggestionResult($response);
    }

    public function google_analyze_competitors($domain, array $options = [])
    {
        $params = [
            'apikey' => $this->apikey,
            'keyword' => $domain,
            'metrics_location' => $options['metrics_location'] ?? '',
            'metrics_language' => $options['metrics_language'] ?? '',
            'metrics_network' => 'googlesearchnetwork',
            'metrics_currency' => 'USD',
            'output' => 'json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::GoogleAnalyzeCompetitorsEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($ch);
        $response = json_decode($output);

        return $response;
    }
}
