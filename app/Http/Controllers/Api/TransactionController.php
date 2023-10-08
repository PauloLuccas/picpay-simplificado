<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TransactionServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;

class TransactionController extends Controller
{

    private TransactionServiceInterface $transactionService;

    public function __construct(TransactionServiceInterface $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function createTransaction(Request $transactionDTO): JsonResponse
    {
        try {

            $newTransaction = $this->transactionService->createTransaction((object)$transactionDTO->all());

            return response()->json($newTransaction, Response::HTTP_OK);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
