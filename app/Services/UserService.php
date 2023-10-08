<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Enums\UserType;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validateTransaction(User $user, string $amount): void
    {
        // TODO: Pegar o tipo do usuário para comparar na condição do $sender
        if($user->userType == UserType::MERCHANT) {
            throw new Exception('Usuário do tipo logista não está autorizado a realizar transação.');
        }

        // TODO: Pegar o balance para comparar na condição do $sender
        if($user->balance < $amount) {
            throw new Exception('Saldo insuficiente.');
        }
    }

    public function findUserById(string $id)
    {
        $result = $this->userRepository->findUserById($id);

        if(empty($result)) {
            throw new Exception('Usuário não encontrado');
        } else {
            return $result;
        }
    }

    public function saveUser(array $user): void
    {
        try {
            $this->userRepository->create($user);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function createUser(array $userDTO): User
    {
        try {

            $newUser = new User($userDTO);
            $this->saveUser($userDTO);

            return $newUser;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getAllUsers(): Collection
    {
        try {

            return $this->userRepository->findAll();

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function updateUser(int $id,array $newUser): void
    {
        try {

            $this->userRepository->update($id, $newUser);

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

}
