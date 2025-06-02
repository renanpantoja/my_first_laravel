<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(SessionStoreRequest $request): RedirectResponse
    {
        $request->authenticate();

        return redirect('/');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }
}