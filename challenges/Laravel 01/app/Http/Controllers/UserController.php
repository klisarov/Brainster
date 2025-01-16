<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function showForm()
    {
        return view('form');
    }

    public function info()
    {
        if (!Session::has('name')) {
            return redirect()->route('form');
        }
        return view('info');
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha|max:15',
            'lastname' => 'required|alpha|max:25',
            'email' => 'nullable|email'
        ], [
            'name.required' => 'The name field is required.',
            'name.alpha' => 'The name may only contain letters.',
            'name.max' => 'The name may not be greater than 15 characters.',
            'lastname.required' => 'The lastname field is required.',
            'lastname.alpha' => 'The lastname may only contain letters.',
            'lastname.max' => 'The lastname may not be greater than 25 characters.',
            'email.email' => 'The email must be a valid email address.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        Session::put('name', $request->name);
        Session::put('lastname', $request->lastname);
        Session::put('email', $request->email);

        return redirect()->route('info');
    }

    public function clearSession()
    {
        Session::forget(['name', 'lastname', 'email']);
        return redirect()->route('home');
    }
}