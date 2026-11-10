<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SiteDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct(protected SiteDataService $data)
    {
    }

    /**
     * Show Admin Login Page
     */
    public function showLogin()
    {
        // If already has valid admin token, go directly to dashboard
        if (session('terra_admin_token') && session('terra_admin_role') === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login', [
            'site' => $this->data->site()
        ]);
    }

    /**
     * Process Admin Login Submission (strictly admin credentials)
     */
    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        // Must be an admin user
        if ($user && $user->role === 'admin' && Hash::check($password, $user->password)) {
            // Generate distinct admin token
            $adminToken = 'adm_' . Str::random(40);
            
            // Set exclusive admin session variables
            session([
                'terra_admin_token' => $adminToken,
                'terra_admin_role' => 'admin',
                'terra_admin_user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => 'Super Admin'
                ]
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di Portal Administrator Terra SDGs.');
        }

        // If user exists but is a regular user trying to access admin
        if ($user && $user->role === 'user') {
            return back()->with('error', 'Akses ditolak: Akun ini terdaftar sebagai User biasa dan tidak memiliki hak akses Administrator.');
        }

        return back()->with('error', 'Kredensial Administrator tidak valid. Periksa email dan kata sandi Anda.');
    }

    /**
     * Logout Admin (clears only admin tokens)
     */
    public function logout()
    {
        session()->forget(['terra_admin_token', 'terra_admin_role', 'terra_admin_user']);
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar dari Portal Administrator.');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'dashboard'
        ]);
    }

    public function events()
    {
        return view('admin.events', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'events'
        ]);
    }

    public function storeEvent(Request $request)
    {
        return redirect()->route('admin.events')->with('success', 'Kegiatan/Event baru berhasil ditambahkan.');
    }

    public function deleteEvent($id)
    {
        return redirect()->route('admin.events')->with('success', 'Kegiatan berhasil dihapus dari sistem.');
    }

    public function participants()
    {
        return view('admin.participants', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'participants'
        ]);
    }

    public function articles()
    {
        return view('admin.articles', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'articles'
        ]);
    }

    public function storeArticle(Request $request)
    {
        return redirect()->route('admin.articles')->with('success', 'Artikel baru berhasil disimpan.');
    }

    public function deleteArticle($id)
    {
        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil dihapus.');
    }

    public function users()
    {
        return view('admin.users', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'users'
        ]);
    }

    public function storeUser(Request $request)
    {
        return redirect()->route('admin.users')->with('success', 'Admin baru berhasil diundang.');
    }

    public function deleteUser($id)
    {
        return redirect()->route('admin.users')->with('success', 'Akses admin berhasil dinonaktifkan.');
    }

    public function activityLogs()
    {
        return view('admin.activity_logs', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'logs'
        ]);
    }
}
