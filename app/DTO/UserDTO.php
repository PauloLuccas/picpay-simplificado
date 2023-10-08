<?php

namespace App\DTO;

class UserDTO
{
    public string $firstName;
    public string $lastName;
    public string $document;
    public int $balance;
    public string $email;
    public string $password;

    public function __construct(
        string $firstName,
        string $lastName,
        string $document,
        int $balance,
        string $email,
        string $password
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->document = $document;
        $this->balance = $balance;
        $this->email = $email;
        $this->password = $password;
    }

}
