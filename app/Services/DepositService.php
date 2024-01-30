<?php

namespace App\Services;

use App\Services\Services;
use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\Hash;

class DepositService extends Services
{
    protected $statementRepository;

    public function __construct(StatementRepository $statementRepository)
    {
        $this->statementRepository = $statementRepository;
    }

    public function store($request){
        $user = auth()->user();

        $depositArray = [
            "user_id"           => $user->id,
            "statement_type_id" => $request->type,
            "value"             => $this->floatToInt($request->value)
        ];

        return $this->statementRepository->storeDeposit($depositArray);
    }




}

