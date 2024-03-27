<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'position' => ['nullable', 'string', Rule::in(['ui designer', 'frontend', 'backend', 'fullstack', 'devops'])],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        if ($request->hasFile('avatar_path')) {
            $file = $request->file('avatar_path');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $avatarPath = $file->storeAs('avatars', $fileName, 'public');
        } else {
            $avatarPath = null;
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'position' => $request->position,
            'password' => Hash::make($request->password),
            'avatar_path' => $avatarPath,
        ]);

        event(new Registered($user));

        return back()->with('success', 'Registration successful');
    }
}
