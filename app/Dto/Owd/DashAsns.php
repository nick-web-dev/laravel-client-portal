<?php
namespace App\Dto\Owd;

class DashAsns
{
    public $pending;
    public $inProcess;
    public $nonconforming;
    public $arrived;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->pending = $data['pending'] ?? 0;
        $instance->inProcess = $data['inProcess'] ?? 0;
        $instance->nonconforming = $data['nonconforming'] ?? 0;
        $instance->arrived = $data['arrived'] ?? 0;

        return $instance;
    }

}
