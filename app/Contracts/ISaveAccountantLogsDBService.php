<?php
namespace App\Contracts;

interface ISaveAccountantLogsDBService {
    public function saveLog($logTitle);
}