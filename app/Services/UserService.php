<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        return $user = auth()->user();
    }

    public function store($request){
        $requestHashedPassword = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        return $this->userRepository->store($requestHashedPassword);
    }

    public function getUserByEmail($email){
        return $this->userRepository->GetByEmail($email);
    }


}

