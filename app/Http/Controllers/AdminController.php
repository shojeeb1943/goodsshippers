<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Demo credentials — no DB needed for now
    private const ADMIN_EMAIL    = 'admin@goodsshippers.com';
    private const ADMIN_PASSWORD = 'admin123';
    private const ADMIN_NAME     = 'Super Admin';

    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Handle admin login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (
            $request->email === self::ADMIN_EMAIL &&
            $request->password === self::ADMIN_PASSWORD
        ) {
            session([
                'admin_logged_in' => true,
                'admin_name'      => self::ADMIN_NAME,
                'admin_email'     => self::ADMIN_EMAIL,
            ]);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials.'])->withInput($request->only('email'));
    }

    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        // Aggregate stats — pull from DB when models are ready
        $stats = [
            'total_users'       => \App\Models\User::count(),
            'total_orders'      => \App\Models\Order::count(),
            'pending_shipments' => \App\Models\Shipment::where('status', 'pending')->count(),
            'open_tickets'      => \App\Models\Ticket::where('status', 'open')->count(),
        ];

        $recentOrders = \App\Models\Order::with('user')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_name', 'admin_email']);

        return redirect()->route('admin.login');
    }
}
