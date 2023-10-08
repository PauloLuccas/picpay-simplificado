<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function findUserByDocument(String $document);

    public function findUserById(String $id);

    public function create(array $user): void;

    public function findAll(): Collection;

    public function update(int $id,array $newUser): void;
}
