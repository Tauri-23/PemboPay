<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class employee_sidenav extends Component
{
    /**
     * Create a new component instance.
     */
    public $activeLink;
    
    public function __construct($activeLink)
    {
        $this->activeLink = $activeLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee-sidenav');
    }
}
