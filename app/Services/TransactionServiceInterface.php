<?php

namespace App\Services;

use App\DTO\TransactionDTO;
use App\Models\Transaction;
use App\Models\User;

interface TransactionServiceInterface
{

    public function createTransaction(object $transaction): Transaction;

    public function authorizeTransaction(User $user, string $value);

}
