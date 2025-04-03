<?php

namespace App\Service;

use App\Repositories\Contracts\IUserRepo;
use App\Service\Contracts\IUserService;
use Exception;

class UserService implements IUserService
{
    protected $userRepo;
    private const PAGE_SIZE = 10;

    public function __construct(IUserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers()
    {
        try {
            return $this->userRepo->getAllUsers();
        } catch (Exception $e) {
            return response()->json(['error' => 'An error has occured. Error: ' . $e->getMessage()], 500);
        }
    }

    public function getAllUsersWithPagination()
    {
        try {
            return $this->userRepo->getAllUsersWithPagination(self::PAGE_SIZE);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error has occured. Error: ' . $e->getMessage()], 500);
        }
    }

    public function createUser(array $data)
    {
        try {
            return $this->userRepo->createUser($data);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error has occured. Error: ' . $e->getMessage()], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            return $this->userRepo->createUser($id);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error has occured. Error: ' . $e->getMessage()], 500);
        }
    }
}
