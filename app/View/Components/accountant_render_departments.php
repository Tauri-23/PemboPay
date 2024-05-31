<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class accountant_render_departments extends Component
{
    public $departments;
    public function __construct($departments)
    {
        $this->departments = $departments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.accountant_render_departments');
    }
}
