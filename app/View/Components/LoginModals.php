<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoginModals extends Component
{
    /**
     * Create a new component instance.
     */
    public $modalType;
    public function __construct($modalType)
    {
        $this->modalType = $modalType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.login-modals');
    }
}
