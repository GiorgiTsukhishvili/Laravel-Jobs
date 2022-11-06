<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function create()
	{
		return view('users.register');
	}

	public function store(Request $request)
	{
		$formFields = $request->validate(
			[
				'name'      => 'required|min:3',
				'email'     => 'required|email|unique:users,email',
				'password'  => 'required|confirmed',
			]
		);

		$formFields['password'] = bcrypt($formFields['password']);

		$user = User::create($formFields);

		auth()->login($user);

		return redirect('/')->with('message', 'User registered successfully!');
	}

	public function logout()
	{
		auth()->logout();

		request()->session()->invalidate();
		request()->session()->regenerate();

		return back()->with('message', 'You have been logged out');
	}

	public function login()
	{
		return view('users.login');
	}

	public function authenticate()
	{
		$formFields = request()->validate(
			[
				'email'     => 'required|email',
				'password'  => 'required',
			]
		);

		if (auth()->attempt($formFields))
		{
			request()->session()->regenerate();

			return redirect('/')->with('message', 'You are now logged in');
		}

		return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
	}
}
