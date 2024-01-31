<?php

namespace App\Services;

use App\Services\Services;
use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\BusinessException;


class WithdrawService extends Services
{
    protected $statementRepository;
    protected $user;
    protected $statementType;
    protected $value;


    public function __construct(StatementRepository $statementRepository)
    {
        $this->statementRepository = $statementRepository;
    }

    public function withdraw($request){
        $this->user = auth()->user();
        $this->value = -($this->floatToInt($request->value));
        $this->verifyFounds();
        $this->statementType = $request->type;

        return $this->store();
    }

    private function store(){
        $withdrawArray = [
            "user_id"           => $this->user->id,
            "statement_type_id" => $this->statementType,
            "value"             => $this->value
        ];

        return $this->statementRepository->store($withdrawArray);
    }

    private function verifyFounds(){
        $userBalance = $this->statementRepository->getBalance($this->user->id);
        // dd($userBalance + $this->value);
        if(($userBalance + $this->value) >= 0){
            return;
        }

        throw new BusinessException('Saldo Insuficiente');
    }
}

