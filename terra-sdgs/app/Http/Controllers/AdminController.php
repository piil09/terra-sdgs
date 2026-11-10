<?php

namespace App\Http\Controllers;

use App\Services\SiteDataService;
use Illuminate\Http\Request;

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
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login', [
            'site' => $this->data->site()
        ]);
    }

    /**
     * Process Admin Login Submission
     */
    public function processLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!empty($email) && !empty($password)) {
            session(['admin_logged_in' => true, 'admin_user' => $email]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Kombinasi email dan kata sandi tidak valid.');
    }

    /**
     * Logout Admin
     */
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_user']);
        return redirect()->route('admin.login');
    }

    /**
     * Check if admin is authenticated before accessing dashboard
     */
    protected function checkAuth()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.dashboard', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'dashboard'
        ]);
    }

    public function events()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.events', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'events'
        ]);
    }

    public function storeEvent(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return redirect()->route('admin.events')->with('success', 'Kegiatan/Event baru berhasil ditambahkan.');
    }

    public function deleteEvent($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return redirect()->route('admin.events')->with('success', 'Kegiatan berhasil dihapus dari sistem.');
    }

    public function participants()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.participants', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'participants'
        ]);
    }

    public function articles()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.articles', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'articles'
        ]);
    }

    public function storeArticle(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return redirect()->route('admin.articles')->with('success', 'Artikel baru berhasil disimpan.');
    }

    public function deleteArticle($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil dihapus.');
    }

    public function users()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.users', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'users'
        ]);
    }

    public function storeUser(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return redirect()->route('admin.users')->with('success', 'Admin baru berhasil diundang.');
    }

    public function deleteUser($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return redirect()->route('admin.users')->with('success', 'Akses admin berhasil dinonaktifkan.');
    }

    public function activityLogs()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.activity_logs', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'logs'
        ]);
    }
}
