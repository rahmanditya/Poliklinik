<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // Retrieve query parameters for role and role_id
        $role = $request->query('role');

        // Validate role against allowed roles
        if (!in_array($role, ['admin', 'dokter', 'pasien'])) {
            abort(404, 'Invalid role specified.');
        }

        // Pass role and role_id to the view
        return view('auth.login', compact('role'));
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

        // Attempt to log in the user with email and password
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Ensure the role_id from the form matches the logged-in user's role_id
            if ($user->role != $request->input('role')) {
                Auth::logout(); // Logout the user if the roles do not match
                return back()->withErrors(['login_error' => 'Password atau Email salah.'])->withInput();
            }
                        // 'Anda bukan ' . $user->role . '.'


            // Redirect based on the user's role
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
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token for security

        return redirect()->route('home'); // Redirect to the home route (defined below)
    }
}
