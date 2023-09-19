<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function findUserByDocument(String $document)
    {
        return User::where('document', $document);
    }

    public function findUserById(String $id)
    {
        User::findOrFail($id);
    }

}
