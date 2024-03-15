<?php
namespace App\Contracts;

interface ILoggedService {
    public function retrieveLoggedAccountant($logged_id);
}