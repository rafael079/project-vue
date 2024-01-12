<?php

namespace App\Contracts\Repository;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    /**
     * @param Request $request
     * 
     * @return User
     */
    public function create(Request $request): User;

    /**
     * @param string $username
     */
    public function checkIfUsernameExists(string $username): bool;

    /**
     * @param string $email
     */
    public function checkIfEmailExists(string $email): bool;
}