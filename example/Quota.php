<?php

use InboundAsia\KeywordTool\KeywordTool;
use InboundAsia\KeywordTool\QuotaResult;

require __DIR__ . '/../vendor/autoload.php';

$key = 'your-api-key';

/** @var QuotaResult */
$result = (new KeywordTool($key))->quota();

print_r('Daily Quota: ' . $result->getDailyQuota() . PHP_EOL);
print_r('Daily Used: ' . $result->getDailyUsed() . PHP_EOL);
print_r('Daily Remaining: ' . $result->getDailyRemaining() . PHP_EOL);
print_r('Minute Quota: ' . $result->getMinuteQuota() . PHP_EOL);
print_r('Minute Used: ' . $result->getMinuteUsed() . PHP_EOL);
print_r('Minute Remaining: ' . $result->getMinuteRemaining() . PHP_EOL);
