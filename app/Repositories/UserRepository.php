<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function findUserByDocument(String $document)
    {
        return User::where('document', $document);
    }

    public function findUserById(String $id)
    {
        return User::find($id, ['id','firstName', 'lastName', 'document', 'email', 'balance', 'userType']);
    }

    public function create(array $user): void
    {
        User::create($user);
    }

    public function findAll(): Collection
    {
        return User::all('id','firstName', 'lastName', 'document', 'email', 'balance', 'userType');
    }

    public function update(int $id,array $newUser): void
    {
        $user = User::find($id);
        $user->update($newUser);
    }
}
