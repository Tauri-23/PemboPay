<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BrgysSelectOption extends Component
{
    /**
     * Create a new component instance.
     */
    public $brgy;
    public function __construct($brgy)
    {
        $this->brgy = $brgy;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.brgys-select-option');
    }
}
