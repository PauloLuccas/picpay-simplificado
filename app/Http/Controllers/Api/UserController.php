<?php

namespace App\Http\Controllers\Api;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function create(Request $userDTO): \Illuminate\Http\JsonResponse
    {
        try {

            $newUser = $this->userService->createUser($userDTO->all());

            return response()->json($newUser, ResponseAlias::HTTP_CREATED);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getAllUsers(): \Illuminate\Http\JsonResponse
    {
        try {

            $users = $this->userService->getAllUsers();

            return \response()->json($users, ResponseAlias::HTTP_OK);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
