<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
      $role = $request->query('role');
      $roleId = $request->query('role_id');
    
      if (!in_array($role, ['admin', 'dokter', 'pasien'])) {
          abort(404, 'Role not found');
      }
    
      return view('auth.login', compact('role', 'roleId')); // Pass both variables
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect to the appropriate dashboard
            switch ($user->role_id) {
                case 1: return redirect()->route('admin.dashboard');
                case 2: return redirect()->route('dokter.dashboard');
                case 3: return redirect()->route('pasien.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors(['login_error' => 'Role tidak terdaftar.']);
            }
        }

        return back()->withErrors(['login_error' => 'Password atau Email salah.'])->withInput();
    }
}
