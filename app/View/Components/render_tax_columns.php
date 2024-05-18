<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class render_tax_columns extends Component
{
    public $elements;
    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.render_tax_columns');
    }
}
