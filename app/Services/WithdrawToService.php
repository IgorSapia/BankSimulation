<?php

namespace App\Services;

use App\Services\WithdrawService;
use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use App\Exceptions\BusinessException;


class WithdrawToService extends WithdrawService
{
    protected $userService;
    protected $receiver;

    public function __construct(StatementRepository $statementRepository, UserService $userService)
    {
        $this->statementRepository = $statementRepository;
        $this->userService = $userService;
    }

    public function withdrawTo($request){
        $this->user = auth()->user();
        $this->getReceiver($request->receiverEmail);
        $this->withdraw($request);

        dd('$request');
    }

    private function getReceiver($receiverEmail){
        $receiver = $this->userService->getUserByEmail($receiverEmail);
        $this->checkReceiverDifInviter($receiver->id);
        $this->receiver = $receiver;
    }

    private function checkReceiverDifInviter($receiverId){
        if($this->user->id != $receiverId){
            return;
        }

        throw new BusinessException('Impossibilidade de envio para sí próprio por meio desta função, utilize depósito p/ tal fim.');
    }
}

