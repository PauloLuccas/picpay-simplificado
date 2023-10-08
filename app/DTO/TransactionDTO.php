<?php

namespace App\DTO;

class TransactionDTO
{
    public string $value;
    public string $senderId;
    public string $receiverId;

    public function __construct(string $value, string $senderId, string $receiverId)
    {
        $this->value = $value;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
    }

}
