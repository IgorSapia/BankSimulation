<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Models\Statement;
use Illuminate\Database\Eloquent\Builder;


class StatementRepository extends Repository
{
    protected $model = Statement::class;

    public function store($storeData){
        return $this->model::create($storeData);
    }

    public function getBalance($userId){
        return $this->model::where('user_id', $userId)->sum('value');
    }
}
