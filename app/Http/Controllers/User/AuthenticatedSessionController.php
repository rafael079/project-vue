<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthenticatedSessionStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(AuthenticatedSessionStoreRequest $authenticatedSessionStoreRequest): RedirectResponse
    {
        $authenticatedSessionStoreRequest->authenticate();

        $authenticatedSessionStoreRequest->session()->regenerate();

        return redirect()->route('home');
    }
}
