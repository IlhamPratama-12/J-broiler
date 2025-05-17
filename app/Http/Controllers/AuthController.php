<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index() {
        return view('admin.pages.auth.login');
    }
    // public function register(Request $request)
    // {
    //     $input = $request->validate([
    //         'name' => 'required',
    //         'username' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //     ]);
    //     $input['password'] = Hash::make($input['password']);
    //     $user = User::create($input);
    //     $success['token'] =  $user->createToken('MyApp')->plainTextToken;
    //     $success['name'] =  $user->name;

    //     return $this->sendResponse($success, 'User register successfully.');
    // }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login Berhasil, Selamat Datang '. $validated['username']);
        }
        return back()->with(['error' => 'Login Gagal! Username dan password tidak sesuai'])->onlyInput('username');
        // $user = User::where('username', $validated['username'])->first();
        // if(isset($user) && Hash::check($validated['password'], $user->password)) {
        // }
        // return back()->with([
        //     'loginError' => 'Login gagal!',
        // ]);
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}

