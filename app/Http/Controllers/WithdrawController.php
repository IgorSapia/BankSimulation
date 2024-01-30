<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\WithdrawRequest;
use App\Http\Requests\WithdrawToRequest;
use App\Http\Requests\UserDataRequest;
use App\Services\WithdrawService;
use App\Services\WithdrawToService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class WithdrawController extends Controller
{
    protected $withdrawService;
    protected $withdrawToService;

    public function __construct(WithdrawService $withdrawService, WithdrawToService $withdrawToService){
        $this->withdrawService = $withdrawService;
        $this->withdrawToService = $withdrawToService;
    }

    public function index(){

    }

    public function store(WithdrawRequest $request){
        DB::beginTransaction();
        try{
            $storeService = $this->withdrawService->withdraw($request);
            DB::commit();
            return response()->json($request, 200);
        }catch(Exception $error){
            Log::error($e->getMessage());
            DB::rollback();
        }
    }

    public function withdrawTo(WithdrawToRequest $request){
        DB::beginTransaction();
        try{
            $storeService = $this->withdrawToService->withdrawTo($request);
            DB::commit();
            return response()->json($request, 200);
        }catch(Exception $error){
            Log::error($e->getMessage());
            DB::rollback();
        }
    }
}
