<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IUserRepo;

class UserRepo implements IUserRepo
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getAllUsersWithPagination($page_size)
    {
        return User::paginate($page_size);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function createUser(array $data)
    {
        $user = new User();
        $user->full_name = $data['full_name'];
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'];
        $user->date_of_birth = $data['date_of_birth'];
        $user->save();

        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}
