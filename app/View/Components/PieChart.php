<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PieChart extends Component
{
    public $percent;
    public $formatted;
    public $barColor;
    public $barColors;
    public $colorClass;
    public $textColor;
    public $size;
    public $trackWidth;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($percent, $format = '%d%%', $barColor = null, $barColors = null, $colorClass = null, $textColor = null, $size = 86, $trackWidth = 6)
    {
        $this->percent = $percent;
        $this->formatted = sprintf($format, $percent);
        $this->barColor = $barColor;
        $this->barColors = $barColors;
        $this->colorClass = $colorClass;
        $this->textColor = $textColor;
        $this->size = $size;
        $this->trackWidth = $trackWidth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.pie-chart');
    }
}
