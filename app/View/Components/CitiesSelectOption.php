<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CitiesSelectOption extends Component
{
    public $cities;
    public function __construct($cities)
    {
        $this->cities = $cities;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cities-select-option');
    }
}
