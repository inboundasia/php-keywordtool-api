<?php

namespace InboundAsia\KeywordTool;

class QuotaResult
{
    protected $daily_quota = 0;
    protected $daily_used = 0;
    protected $daily_remaining = 0;

    protected $minute_quota = 0;
    protected $minute_used = 0;
    protected $minute_remaining = 0;

    public function __construct($data)
    {
        $daily_limit = $data->limits->daily;
        $minute_limit = $data->limits->minute;

        $this->daily_quota = $daily_limit->quota;
        $this->daily_used = $daily_limit->used;
        $this->daily_remaining = $daily_limit->remaining;

        $this->minute_quota = $minute_limit->quota;
        $this->minute_used = $minute_limit->used;
        $this->minute_remaining = $minute_limit->remaining;
    }

    public function getDailyQuota()
    {
        return $this->daily_quota;
    }

    public function getDailyUsed()
    {
        return $this->daily_used;
    }

    public function getDailyRemaining()
    {
        return $this->daily_remaining;
    }

    public function getMinuteQuota()
    {
        return $this->minute_quota;
    }

    public function getMinuteUsed()
    {
        return $this->minute_used;
    }

    public function getMinuteRemaining()
    {
        return $this->minute_remaining;
    }
}