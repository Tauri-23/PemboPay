<?php
namespace App\Contracts;

interface IComputePayrollService {
    public function process($month, $period, $year);
}