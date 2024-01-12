<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AuthenticatedSessionStoreRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(AuthenticatedSessionStoreRequest $authenticatedSessionStoreRequest): RedirectResponse
    {
        $authenticatedSessionStoreRequest->authenticate();

        $authenticatedSessionStoreRequest->session()->regenerate();

        return redirect()->route(
            $authenticatedSessionStoreRequest->redirect['route'] ?? RouteServiceProvider::HOME,
            $authenticatedSessionStoreRequest->redirect['params'] ?? null
        );
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
