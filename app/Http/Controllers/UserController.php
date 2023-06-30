<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
     // Show Register Form
     public function create() {
        return view('users.register');
    }
     // Create New User
     public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
        ]);
        
        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        //$formFields['role'] = 1;
        //dd($formFields);
        // Create User
        $user = User::create($formFields);
        //dd($user);
        // Login
        //auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }


      // Show Login Form
      public function login() {
        return view('users.login');
    }


     // Authenticate User
     public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/profile')->with('message', 'Sie sind eingellogt');
        }
        return back()->withErrors(['email' => 'Ungültige Zugangsdaten'])->onlyInput('email');
    }


     // Logout User
     public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Sie sind abgemeldet');

    }

    // Show User Dashboard
    public function account() {
        return view('users.applicants.account');
    }

}
