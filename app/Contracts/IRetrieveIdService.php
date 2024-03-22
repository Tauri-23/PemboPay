<?php
namespace App\Contracts;

interface IRetrieveIdService {
    public function retrieveId($model, $id);
}