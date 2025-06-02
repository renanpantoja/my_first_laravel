<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        $user = User::create($request->only(['name', 'email', 'password']));

        $logoPath = $request->file('logo')->store('logos');

        $user->employer()->create([
            'name' => $request->employer,
            'logo' => $logoPath,
        ]);

        Auth::login($user);

        return redirect('/');
    }
}