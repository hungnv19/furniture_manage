<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register.index', [
            'title' => 'Dang ky'
        ]);
    }
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status =  1 ;
        $user->password = Hash::make($request->password);
        $user->save();
       
        auth()->login($user);
        return redirect()->route('home.index');
    }
}
