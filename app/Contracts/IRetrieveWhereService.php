<?php
namespace App\Contracts;

interface IRetrieveWhereService {
    public function retrieveWhere($model, $conditions);
}