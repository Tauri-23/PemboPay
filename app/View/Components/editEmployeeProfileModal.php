<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class editEmployeeProfileModal extends Component
{
    public $modalType;
    public $cities;
    public $brgys;

    public function __construct($modalType, $cities, $brgys)
    {
        $this->modalType = $modalType;
        $this->cities = $cities;
        $this->brgys = $brgys;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-employee-profile-modal');
    }
}
