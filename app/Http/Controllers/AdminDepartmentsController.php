<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateIdService;
use App\Contracts\ISendEmailService;
use Illuminate\Http\Request;

class AdminDepartmentsController extends Controller
{
    protected $generateId;
    protected $emailSender;

    public function __construct(IGenerateIdService $generateId, ISendEmailService $emailSender) {
        $this->generateId = $generateId;
        $this->emailSender = $emailSender;
    }

    public function index() {
        
    }
}
