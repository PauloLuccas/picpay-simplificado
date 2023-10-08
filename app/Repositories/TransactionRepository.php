<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function create(Transaction $transaction)
    {
        Transaction::create($transaction->attributesToArray());
    }

}
