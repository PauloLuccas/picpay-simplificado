<?php

namespace App\Services;

use App\DTO\TransactionDTO;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Ramsey\Collection\Collection;

class TransactionService implements TransactionServiceInterface
{
    protected UserServiceInterface $userService;
    protected TransactionRepository $transactionRepository;
    protected NotificationServiceInterface $notificationService;

    public function __construct(
        UserServiceInterface $userService,
        TransactionRepository $transactionRepository,
        NotificationServiceInterface $notificationService
    )
    {
        $this->userService = $userService;
        $this->transactionRepository = $transactionRepository;
        $this->notificationService = $notificationService;
    }

    /**
     * @throws \Exception
     */
    public function createTransaction(object $transaction): Transaction
    {
        try {
            $sender = $this->userService->findUserById($transaction->senderId);

            $receiver = $this->userService->findUserById($transaction->receiverId);

            $this->userService->validateTransaction($sender, $transaction->value);

            if(!$this->authorizeTransaction($sender, $transaction->value)) {
                throw new \Exception('Transação não autorizada');
            }

            $newTransaction = new Transaction();
            $newTransaction->setAttribute('amount', $transaction->value);
            $newTransaction->setAttribute('sender_id', $transaction->senderId);
            $newTransaction->setAttribute('receiver_id', $transaction->receiverId);


            $sender->balance -= $transaction->value;
            $receiver->balance += $transaction->value;

            $this->transactionRepository->create($newTransaction);
            $this->userService->updateUser($sender->id, $sender->toArray());
//            $this->userService->saveUser($sender->toArray());
//            $this->userService->saveUser($receiver->toArray());

            $this->notificationService->sendNotification($sender, "Transação realizada com sucesso.");
            $this->notificationService->sendNotification($receiver, "Transação realizada com sucesso.");

            return $newTransaction;

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function authorizeTransaction(User $sender, string $value)
    {
        $number = random_int(1,2);


        $authorize = $number == 1 ? 'aprovado' : 'reprovado';

        $response = Http::get('http://localhost:3000/'.$authorize);
        $mensagem = json_decode($response->body())->mensagem;

        return $mensagem == 'Aprovado';
    }

}
