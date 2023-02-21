<?php
namespace App\Dto\Owd;

class DashReceives
{
    public $total;
    public $nonConforming;


    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->total = $data['total'] ?? 0;
        $instance->nonConforming = $data['nonconforming'] ?? 0;

        return $instance;
    }

}
