<?php

namespace App\Services;

use App\Services\WithdrawService;
use App\Repositories\StatementRepository;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use App\Services\TransactionService;
use App\Exceptions\BusinessException;


class WithdrawToService extends WithdrawService
{
    protected $userService;
    protected $receiver;
    protected $depositService;
    protected $withdrawStoredData;
    protected $depositStoredData;
    protected $transactionService;


    public function __construct(StatementRepository $statementRepository, UserService $userService, DepositService $depositService, TransactionService $transactionService)
    {
        $this->statementRepository = $statementRepository;
        $this->userService = $userService;
        $this->depositService = $depositService;
        $this->transactionService = $transactionService;
    }

    public function withdrawTo($request){
        $this->user = auth()->user();
        $this->getReceiver($request->receiverEmail);
        $this->withdrawStoredData = $this->withdraw($request);
        $this->depositStoredData  = $this->depositService->depositTo($this->receiver, 4, $request->value);
        return $this->createTransaction();
    }

    private function createTransaction(){
        return $this->transactionService->index($this->withdrawStoredData, $this->depositStoredData);
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

