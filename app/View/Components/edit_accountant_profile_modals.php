<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class edit_accountant_profile_modals extends Component
{
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
        return view('components.edit_accountant_profile_modals');
    }
}
