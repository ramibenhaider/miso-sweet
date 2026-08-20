<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role == 'user') {
            $user = User::where('id', auth()->id())->first();
            return view('user.home', compact('user'));
        } else {
            return view('user.home');
        }
    }
}
