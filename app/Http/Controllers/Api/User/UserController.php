<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function checkIfUsernameExists(string $username, UserRepository $userRepository): bool
    {
        return $userRepository->checkIfUsernameExists($username);
    }

    public function checkIfEmailExists(string $email, UserRepository $userRepository): bool
    {
        return $userRepository->checkIfEmailExists($email);
    }

}
