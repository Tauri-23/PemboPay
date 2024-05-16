<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin_side_nav extends Component
{
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
        return view('components.admin_side_nav');
    }
}
