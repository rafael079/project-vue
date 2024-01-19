<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\FollowRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(FollowRequest $request)
    {
        $userToFollow = User::where(['username' => $request->username])->first();

        if (Auth::user()->isFollowing($userToFollow)) {
            Auth::user()->unfollow($userToFollow);

            return 'unfollow';

        } else {
            Auth::user()->follow($userToFollow);

            return 'follow';
        }

    }
}
