<?php
namespace App\Contracts;

interface IGenerateFilenameService {
    public function generate($file, $targetDirectory);
}