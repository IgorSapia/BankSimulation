<?php

namespace App\Services;

use App\Services\Services;
use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\Hash;

class DepositService extends Services
{
    protected $statementRepository;
    protected $user;
    protected $statementType;
    protected $value;

    public function __construct(StatementRepository $statementRepository)
    {
        $this->statementRepository = $statementRepository;
    }

    public function deposit($request){
        $this->user = auth()->user();
        $this->value = $this->floatToInt($request->value);
        $this->statementType = $request->type;

        $this->store();
    }

    public function depositTo($reciver, $statementType, $value){
        $this->user = $reciver;
        $this->value = $this->floatToInt($value);
        $this->statementType = $statementType;

        return $this->store();
    }

    private function store(){
        $depositArray = [
            "user_id"           => $this->user->id,
            "statement_type_id" => $this->statementType,
            "value"             => $this->value
        ];

        return $this->statementRepository->store($depositArray);
    }




}

