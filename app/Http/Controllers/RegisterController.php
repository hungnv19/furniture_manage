<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register.index', [
            'title' => 'Dang ky'
        ]);
    }
    public function store()
    {
        $user = User::create(request(['name', 'email', 'password']));
        auth()->login($user);
        return redirect()->route('home.index');
    }
}
