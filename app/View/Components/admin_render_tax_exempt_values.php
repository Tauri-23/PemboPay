<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin_render_tax_exempt_values extends Component
{
    protected $elements;

    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin_render_tax_exempt_values');
    }
}
