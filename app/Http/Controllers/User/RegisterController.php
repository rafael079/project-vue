<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterStoreRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{

    public function create(): Response
    {
        return Inertia::render('Auth/RegisterPage');
    }

    public function store(RegisterStoreRequest $registerStoreRequest, UserRepository $userRepository): RedirectResponse
    {
        $user = $userRepository->create($registerStoreRequest);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }
}
