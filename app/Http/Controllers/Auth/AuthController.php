<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;


class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create a new personal access client
        $client = new Client();
        $client->user_id = $user->id;
        $client->name = $user->name.' Password Grant Client';
        $client->secret = Hash::make($request->password);
        $client->redirect = 'http://example.com';
        $client->personal_access_client = true;
        $client->password_client = true;
        $client->revoked = false;
        $client->save();
        // Redirect to a view indicating successful registration
        return redirect('/')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Get the authenticated user
        $user = Auth::user();

        // Generate a new token for the authenticated user
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        // Redirect to a view indicating successful login
        return redirect('/')->with('success', 'Login successful!');
    } else {
        return redirect()->back()->withErrors(['password' => 'Invalid credentials'])->withInput();
    }
}


    public function edit()
    {
        // Logic to fetch user's profile data
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    public function logout(Request $request)
    {
    // Invalidate the user's session
    auth()->logout();

    // Redirect to a view indicating successful logout
    return redirect('/')->with('success', 'You have been successfully logged out!');
    }


}
