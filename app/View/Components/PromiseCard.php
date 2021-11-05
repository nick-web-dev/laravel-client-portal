<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PromiseCard extends Component
{
    public $title;
    public $description;
    public $icon;
    public $colorClass;
    public $wip;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $icon, $colorClass, $value = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->icon = $icon;
        $this->colorClass = $colorClass;
        $this->wip = is_null($value);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.promise-card');
    }
}
