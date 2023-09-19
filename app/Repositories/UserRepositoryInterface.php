<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findUserByDocument(String $document);

    public function findUserById(String $id);

}
