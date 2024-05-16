<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class render_accountant_logs extends Component
{
    public $logs;
    public $count;

    public function __construct($logs, $count)
    {
        $this->logs = $logs;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.render_accountant_logs');
    }
}
