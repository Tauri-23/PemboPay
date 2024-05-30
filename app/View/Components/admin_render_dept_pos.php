<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin_render_dept_pos extends Component
{
    public $positions;
    public function __construct($positions)
    {
        $this->positions = $positions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin_render_dept_pos');
    }
}
