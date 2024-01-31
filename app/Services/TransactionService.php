<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Hash;

class TransactionService
{
    protected $transactionRepository;
    protected $sentTransaction;
    protected $recivedTransaction;
    protected $transactionDate;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index($sentTransaction, $recivedTransaction){
        $this->sentTransacation =  $sentTransaction;
        $this->recivedTransaction =  $recivedTransaction;

        return $this->store();
    }

    public function store(){
        $transactionArray = [
            'sent_id'    => $this->sentTransacation->id,
            'recived_id' => $this->recivedTransaction->id
        ];

        return $this->transactionRepository->store($transactionArray);
    }
}

