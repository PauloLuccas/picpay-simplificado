<?php

namespace App\DTO;

class NotificationDTO
{
    public string $email;
    public string $message;

    public function __construct(string $email, string $message)
    {
        $this->email = $email;
        $this->message = $message;
    }


}
