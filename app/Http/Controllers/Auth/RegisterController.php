<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validation
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'username' => 'required|max:255',
        //     'email' => 'required|email|max:255',
        //     'password' => 'required|confirmed'   // godson@123
        // ]);
        $this->validate($request, [
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'confirmed']
        ]);
        // Store User
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // SignIn user
        // user or null // use auth Facade or helper here
        auth()->attempt($request->only('email', 'password'));
        // redirect
        return redirect()->route('dashboard');
    }
}
