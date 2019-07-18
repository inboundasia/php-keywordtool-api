<?php

use InboundAsia\KeywordTool\GoogleKeywordSuggestionResult;

require __DIR__ . '/../vendor/autoload.php';

$output = file_get_contents(__DIR__ . '/suggestion.json');
$response = json_decode($output);

$results = new GoogleKeywordSuggestionResult($response);

foreach ($results->getResults() as $result)
{
    print_r('Keyword:' . $result->getString() . PHP_EOL);
    print_r('Volume:' . $result->getVolume() . PHP_EOL);
    print_r('CPC:' . $result->getCpc() . PHP_EOL);
    print_r('CMP:' . $result->getCmp() . PHP_EOL);

    foreach ($result->getVolumes() as $volume)
    {
        printf('%s-%s has volume %s' . PHP_EOL,
            $volume->getYear(), $volume->getMonth(), $volume->getVolume());
    }
}

