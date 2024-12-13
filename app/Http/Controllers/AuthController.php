<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $role = $request->query('role');

        if (!in_array($role, ['admin', 'dokter', 'pasien'])) {
            abort(404, 'Invalid role specified.');
        }

        return view('auth.login', compact('role'));
    }

    public function showRegisterForm(Request $request)
    {
        return view('auth.register');
    }

    public function post(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'medical_record_number' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'date_of_birth' => 'required|date',
            'address' => 'required',
            'password' => 'required|min:6|confirmed', // Password must be confirmed
        ]);

        // Create the `pasien` record
        $pasien = Pasien::create($request->only([
            'medical_record_number',
            'name',
            'email',
            'phone',
            'date_of_birth',
            'address',
        ]));

        // Hash the password
        $hashedPassword = bcrypt($request->password);

        // Get the role ID for 'pasien'
        $role = DB::selectOne("SELECT id FROM roles WHERE role_code = 'pasien'");

        // Create the user record
        DB::table("users")->insert([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hashedPassword,
            "role_id" => $role->id,
            "status_code" => 'user_active',
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // Redirect to the login page with success message
        return redirect()->route('login.index', ['role' => 'pasien'])
            ->with('success', 'Registration successful! Please login.');
    }



    public function homeLogin()
    {
        return view('login');
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role != $request->input('role')) {
                Auth::logout();
                return back()->withErrors(['login_error' => 'Password atau Email salah.'])->withInput();
            }


            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'dokter':
                    return redirect()->route('dokter.dashboard');
                case 'pasien':
                    return redirect()->route('pasien.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors(['login_error' => 'Password atau Email salah.'])->withInput();
            }
        }
        return back()->withErrors(['login_error' => 'Password atau Email salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
