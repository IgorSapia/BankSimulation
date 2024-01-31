<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\StatementService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class StatementController extends Controller
{
    protected $statementService;

    public function __construct(StatementService $statementService){
        $this->statementService = $statementService;
    }

    public function paginateFullStatement($perPage){
        return $this->statementService->paginateOwnFullStatement($perPage);
    }
}
