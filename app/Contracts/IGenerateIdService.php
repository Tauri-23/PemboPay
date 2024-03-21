<?php
namespace App\Contracts;

interface IGenerateIdService {
    public function generate($modelInstance);
}