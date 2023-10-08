<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{

    public function validateTransaction(User $user, String $amount): void;

    public function findUserById(String $id);

    public function saveUser(array $user): void;

    public function createUser(array $userDTO): User;

    public function getAllUsers(): Collection;

    public function updateUser(int $id,array $newUser): void;

}
