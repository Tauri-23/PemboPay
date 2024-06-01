<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class render_payroll_history_full extends Component
{
    public $payrolls;

    public function __construct($payrolls)
    {
        $this->payrolls = $payrolls;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.render_payroll_history_full');
    }
}
