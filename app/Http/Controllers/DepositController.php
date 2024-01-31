<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\UserDataRequest;
use App\Services\DepositService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class DepositController extends Controller
{
    protected $depositService;

    public function __construct(DepositService $depositService){
        $this->depositService = $depositService;
    }

    public function index(){

    }

    public function store(DepositRequest $request){
        DB::beginTransaction();
        try{
            $storeService = $this->depositService->deposit($request);
            DB::commit();
            return response()->json($request, 200);
        }catch(Exception $error){
            Log::error($e->getMessage());
            DB::rollback();
        }
    }
}
