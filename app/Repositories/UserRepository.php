<?php

namespace App\Repositories;

use App\Contracts\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param Request $request
     * 
     * @return User
     */
    public function create(Request $request): User
    {
        return User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => Str::of($request->email)
                ->lower()
                ->snake()
                ->replace('.', '_')
                ->beforeLast('@')
                ->finish('_') . Str::lower(Str::random(3)),
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    public function checkIfUsernameExists(string $username): bool
    {
        $user = User::where('username', $username);

        if (Auth::check()) {
            $user->where('id', '!=', Auth::id());
        }

        return $user->exists();
    }

    public function checkIfEmailExists(string $email): bool
    {
        $user = User::where('email', $email);

        if (Auth::check()) {
            $user->where('id', '!=', Auth::id());
        }

        return $user->exists();
    }
}