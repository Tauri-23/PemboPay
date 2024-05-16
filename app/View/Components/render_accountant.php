<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class render_accountant extends Component
{
    public $accountants;
    public $count;
    public function __construct($accountants, $count)
    {
        $this->accountants = $accountants;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.render_accountant');
    }
}
