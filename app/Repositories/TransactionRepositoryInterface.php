<?php

namespace App\Repositories;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{

    public function create(Transaction $transaction);

}
