<?php
namespace App\Contracts;

interface IGenerateEmpIdService {
    public function generate($modelInstance);
}