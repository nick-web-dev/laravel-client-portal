<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GaugeWidget extends Component
{
    public $percent;
    public $colorClass;
    public $gradient;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($percent, $colorClass = 'primary', $gradient = false)
    {
        $this->percent = $percent;
        $this->colorClass = $colorClass;
        $this->gradient = $gradient;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.gauge-widget');
    }
}
