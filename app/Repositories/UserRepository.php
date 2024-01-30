<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;


class UserRepository extends Repository
{
    protected $model = User::class;

    public function store($request){
        return $this->model::create($request);
    }

    public function GetByEmail($email){
        return $this->model::where('email', $email)->first();
    }
}
