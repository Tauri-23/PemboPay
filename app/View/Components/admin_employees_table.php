<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin_employees_table extends Component
{
    public $employees;
    
    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin_employees_table');
    }
}
