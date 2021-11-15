<?php

namespace App\Dto;

class SalesOrdersTodaySummary
{
    public $posted;
    public $completed;
    public $fulfillmentStatus;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->posted = $data['posted'] ?? 0;
        $instance->completed = $data['completed'] ?? 0;
        $instance->fulfillmentStatus = $data['fulfillmentStatus'] ?? 0;

        return $instance;
    }
}
