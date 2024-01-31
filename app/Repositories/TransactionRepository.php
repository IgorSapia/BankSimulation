<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;


class TransactionRepository extends Repository
{
    protected $model = Transaction::class;

    public function store($storeDataArray){
        return $this->model::create($storeDataArray);
    }
}
