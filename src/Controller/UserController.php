<?php

namespace App\Controller;

use App\Core\Controller;
use App\Repository\UsersRepository;

class UserController extends Controller
{
    public function index()
    {
        return null;
    }

    public function getCollection(UsersRepository $userRepository)
    {
        return $this->jsonResponse([
            'body' => $userRepository->getUsers(),
        ]);
    }

    public function getItem(UsersRepository $userRepository, $id)
    {
        $user = $userRepository->getUser($id);

        if(!$user) {
            return $this->notFoundResponse();
        }

        return $this->jsonResponse([
            'body' => $user,
        ]);
    }

    public function createItem(UsersRepository $usersRepository)
    {
        $input = $this->postJson();

        if(is_array($input)) {
            $usersRepository->insertUser([
                'uuid' => $input['uuid'],
                'username' => $input['username'],
                'name' => $input['name'],
                'address' => $input['address'],
                'job' => $input['job'],
                'card' => $input['card']
            ]);

            return $this->createdJson();
        }
    }

    public function deleteItem(UsersRepository $userRepository, $id)
    {
        $user = $userRepository->getUser($id);

        if(!$user) {
            return $this->notFoundResponse();
        }

        $userRepository->deleteUser($id);

        return $this->jsonResponse([
            'body' => [
                'message' => 'User deleted !',
            ],
        ]);
    }

    public function updateItem(UsersRepository $userRepository, $id)
    {
        $input = $this->postJson();
        $user = $userRepository->getUser($id);

        if(!$user) {
            return $this->notFoundResponse();
        }

        if(is_array($input)) {
            $userRepository->updateUser([
                'uuid' => $input['uuid'],
                'username' => $input['username'],
                'name' => $input['name'],
                'address' => $input['address'],
                'job' => $input['job'],
                'card' => $input['card'],
                'id' => $id,
            ]);

            return $this->jsonResponse([
                'body' => [
                    'message' => 'User updated !',
                ],
            ]);
        }
    }
}
