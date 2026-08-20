<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\registerationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(registerationRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('users', 'public');
        }

        $user = User::create($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
