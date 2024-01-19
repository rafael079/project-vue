<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show(string $username): Response
    {
        $user = User::withCount(['followings', 'followables'])->where("username", $username)->first();

        return Inertia::render('User/ProfileShow', [
            'user' => new UserResource($user),
            'permissions' => [
                'edit' => Auth::check() && Auth::user()->is($user),
            ],
        ]);
    }

    public function update(ProfileUpdateRequest $profileUpdateRequest): RedirectResponse
    {
        $profileUpdateRequest->user()->update($profileUpdateRequest->validated());

        return redirect()->route(
            'users.profile.show',
            ['user' => $profileUpdateRequest->username]
        )->with('success', __('Your Profile Has Been Updated'));
    }
}
