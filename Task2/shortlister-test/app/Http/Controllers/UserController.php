<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\Contracts\IUserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    //Gets all users by 10 on route '/'
    public function getUsersWithPagination()
    {
        $users = $this->userService->getAllUsersWithPagination();
        return view('user', compact('users'));
    }

    //Adds a new user on route '/user'
    public function addUser()
    {
        $validatedData = request()->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:user,email',
            'phone_number' => ['required', 'regex:/^\+[0-9]{10,15}$/'],
            'date_of_birth' => 'required|date',
        ]);
        try {
            $user = $this->userService->createUser($validatedData);

            // Set flash message
        session()->flash('success', 'User added successfully!');

            return response()->json([
                'message' => 'User added successfully!',
            ]);
        } catch (\Exception $e) {
              // Set flash message
        session()->flash('error', 'Error adding user');

        return response()->json([
            'message' => 'User was not added',
        ]);
        }
    }
}
