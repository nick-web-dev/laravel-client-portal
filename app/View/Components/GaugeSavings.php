<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GaugeSavings extends Component
{
    public $savings;

    public function __construct($savings)
    {
        $this->savings = $savings;
    }

    public function render()
    {
        return view('components.gauge-savings');
    }
}
