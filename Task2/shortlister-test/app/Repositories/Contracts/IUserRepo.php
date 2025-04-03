<?php

namespace App\Repositories\Contracts;

interface IUserRepo{
    public function getAllUsers();

    public function getAllUsersWithPagination($page_size);

    public function getUserById($id);

    public function createUser(array $data);

    public function deleteUser($id);
}