<?php

namespace App\Services;

use App\Services\Services;
use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

class BalanceService extends Services
{
    protected $statementRepository;
    protected $userService;

    public function __construct(StatementRepository $statementRepository)
    {
        $this->statementRepository = $statementRepository;
    }

    public function index(){
        $user = auth()->user();
        return $this->intToFloat($this->statementRepository->getBalance($user->id));
    }





}

