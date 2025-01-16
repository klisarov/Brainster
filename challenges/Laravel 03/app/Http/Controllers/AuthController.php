<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();
        
        if ($user && password_verify($request->password, $user->password)) {
            session(['logged_in' => true]);
            return redirect('/admin/projects');
        }

        return back()->withErrors(['email' => 'Невалидни податоци']);
    }

    public function logout()
    {
        session()->forget('logged_in');
        return redirect('/');
    }
}

?>