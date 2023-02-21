<?php

namespace App\Dto\Owd;

class DashPromisesMet{
    public $onTimePercent;
    public $fulfilmentAccuracyPercent;
    public $fulfilmentSavings;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->onTimePercent = $data['onTimePercent'] ?? 0;
        $instance->fulfilmentAccuracyPercent = $data['fulfilmentAccuracyPercent'] ?? 0;
        $instance->fulfilmentSavings = $data['fulfilmentSavings'] ?? 0;

        return $instance;
    }
}
