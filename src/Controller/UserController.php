<?php

namespace App\Controller;

use Monolog\Logger;
use App\Core\Controller;
use Evenement\EventEmitter;
use App\Repository\UsersRepository;

class UserController extends Controller
{


    public function index()
    {
        return null;
    }

    public function getCollection(UsersRepository $userRepository, EventEmitter $emitter, Logger $logger)
    {
        $users = $userRepository->getUsers();
        $emitter->emit('user.display', [$users]);

        $logger->info($_SERVER['HTTP_USER_AGENT']);

        return $this->jsonResponse([
            'body' => $users,
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
