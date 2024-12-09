<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {
        $user = User::with('role_id')->find(Auth::id());
        // $user = Auth::user();
        dd($user->role_id); // Ensure it's a valid User instance

        if (!$user) {
            abort(401, 'User not authenticated');
        }

        if (!Auth::check()) {
            return redirect()->route('/');
        }


        switch ($user->role_id) { // This relies on the getRoleAttribute
            case '1':
                return redirect()->route('admin.dashboard');
            case '2':
                return redirect()->route('dokter.dashboard');
            case '3':
                return redirect()->route('pasien.dashboard');
            default:
                abort(403, 'Unauthorized access');
        }
    }



    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
