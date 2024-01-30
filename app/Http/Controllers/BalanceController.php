<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BalanceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class BalanceController extends Controller
{
    protected $balanceService;

    public function __construct(BalanceService $balanceService){
        $this->balanceService = $balanceService;
    }

    public function index(){
        return response()->json($this->balanceService->index(), 200);
    }
}
