<?php

namespace App\Service\Contracts;

interface IUserService{
    public function getAllUsers();
    public function getAllUsersWithPagination();
    public function createUser(array $data);
    public function deleteUser($id);
}

