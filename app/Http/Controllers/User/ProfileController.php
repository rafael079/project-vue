<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show(User $user): Response
    {
        return Inertia::render('User/ProfileShow', [
            'user' => new UserResource($user),
            'permissions' => [
                'edit' => Auth::check() && Auth::user()->is($user),
            ],
        ]);
    }
}
