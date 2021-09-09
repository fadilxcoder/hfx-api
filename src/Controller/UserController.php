<?php

namespace App\Controller;

use App\Core\Controller;
use App\Repository\UsersRepository;

class UserController extends Controller
{
    public function getCollection(UsersRepository $userRepository)
    {
        return $this->jsonResponse([
            'body' => $userRepository->getUsers(),
        ]);
    }

    public function getItem(UsersRepository $userRepository, $id)
    {
        return $this->jsonResponse([
            'body' => $userRepository->getUser($id),
        ]);
    }
}
