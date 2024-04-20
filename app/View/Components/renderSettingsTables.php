<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class renderSettingsTables extends Component
{
    /**
     * Create a new component instance.
     */
    public $elements;
    public $elementsName;
    public function __construct($elements, $elementsName)
    {
        $this->elements = $elements;
        $this->elementsName = $elementsName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.render-settings-tables');
    }
}
