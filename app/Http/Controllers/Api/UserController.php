<?php

namespace App\Http\Controllers\Api;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    // TODO: Criar um request personalizavel para o User.
    public function create(Request $userDTO)
    {
        try {

            $newUser = $this->userService->createUser($userDTO->all());

            return response()->json($newUser, Response::HTTP_CREATED);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getAllUsers()
    {
        try {

            $users = $this->userService->getAllUsers();

            return \response()->json($users, Response::HTTP_OK);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
