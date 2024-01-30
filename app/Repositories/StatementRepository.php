<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Models\Statement;
use Illuminate\Database\Eloquent\Builder;


class StatementRepository extends Repository
{
    protected $model = Statement::class;

    public function storeDeposit($createDeposit){
        return $this->model::create($createDeposit);
    }

    public function getBalance($userId){
        return $this->model::where('user_id', $userId)->sum('value');
    }
}
