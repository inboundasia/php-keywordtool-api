<?php

use InboundAsia\KeywordTool\KeywordTool;

require __DIR__ . '/../vendor/autoload.php';

$key = 'your-api-key';

$results = (new KeywordTool($key))->google_keyword_suggestions(
    '行銷', [
    'metrics_location' => '2158',
    'metrics_language' => 'zh-TW'
]);

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

