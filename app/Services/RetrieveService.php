<?php
namespace App\Services;

use App\Contracts\IRetrieveIdService;
use App\Contracts\IRetrieveService;
use App\Contracts\IRetrieveWhereService;

class RetrieveService implements IRetrieveService, IRetrieveIdService, IRetrieveWhereService {
    public function retrieve($modelInstance) {
        return $modelInstance::all();
    }

    public function retrieveId($modelInstance, $id) {
        return $modelInstance::find($id);
    }

    public function retrieveWhere($modelInstance, $conditions) {
        // Check if $modelInstance is a string
        if (is_string($modelInstance)) {
            // Resolve the model instance from the string
            $modelInstance = app($modelInstance);
        }
        
        $query = $modelInstance;

        foreach($conditions as $condition) {
            list($column, $operator, $value) = $condition;

            $query = $query->where($column, $operator, $value);
        }

        return $query->get();
    }
}