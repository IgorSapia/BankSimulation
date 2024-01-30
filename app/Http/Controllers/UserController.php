<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserDataRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function index(){
        try{
            $user = $this->userService->index();
            return response()->json($user, 200);
        }catch(Exception $error){
            Log::error($error->getMessage());
            return $this->responseError($error->getMessage(), $error->getCode());

        }
    }

    public function store(UserRequest $request){
        // dd($request->json());
        DB::beginTransaction();
        try{
            $storeService = $this->userService->store($request);
            DB::commit();
            return response()->json($request, 200);
        }catch(Exception $error){
            Log::error($e->getMessage());
            DB::rollback();
        }
    }
}
