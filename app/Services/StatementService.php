<?php

namespace App\Services;

use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\Hash;

class StatementService
{
    protected $statementRepository;

    public function __construct(StatementRepository $statementRepository)
    {
        $this->statementRepository = $statementRepository;
    }

    public function paginateOwnFullStatement($perPage){
        $user = auth()->user();
        return $this->statementRepository->PaginatefullStatementPerUser($user->id, $perPage);
    }
}

