<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            
            // Redirect based on role
            if (auth()->user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/employees/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Show Register form
    public function showRegisterForm()
    {
        if (auth()->user()->role !== 'admin') {
        return redirect('/')->with('error', 'Access denied.');
        }
        return view('auth.register');
    }

    // Handle Register
    public function register(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access denied.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'in:admin,employee'  // optional
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'employee',
        ]);

        return redirect('/admin/dashboard')->with('success', 'User created successfully');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
