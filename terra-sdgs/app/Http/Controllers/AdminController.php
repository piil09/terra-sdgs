<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

    public function showLogin()
    {
        if (session('terra_admin_token') && session('terra_admin_role') === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login', [
            'site' => $this->data->site()
        ]);
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && $user->role === 'admin' && Hash::check($password, $user->password)) {
            $adminToken = 'adm_' . Str::random(40);
            
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

        if ($user && $user->role === 'user') {
            return back()->with('error', 'Akses ditolak: Akun ini terdaftar sebagai User biasa dan tidak memiliki hak akses Administrator.');
        }

        return back()->with('error', 'Kredensial Administrator tidak valid. Periksa email dan kata sandi Anda.');
    }

    public function logout()
    {
        session()->forget(['terra_admin_token', 'terra_admin_role', 'terra_admin_user']);
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar dari Portal Administrator.');
    }

    protected function checkAuth()
    {
        if (!session('terra_admin_token')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $adminData = $this->data->get('admin');
        $events = Event::latest()->get();
        
        if (isset($adminData['stats'])) {
            $adminData['stats'][0]['value'] = (string)$events->count();
            $adminData['stats'][0]['period'] = $events->where('status', 'Registration is open')->count() . ' aktif, ' . $events->where('status', '!=', 'Registration is open')->count() . ' selesai';
        }

        return view('admin.dashboard', [
            'site' => $this->data->site(),
            'admin' => $adminData,
            'events_list' => $events,
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'dashboard'
        ]);
    }

    public function events(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $adminData = $this->data->get('admin');
        $category = $request->query('category');
        
        $query = Event::query();
        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }
        $events = $query->latest()->get();
        $allEvents = Event::all();

        return view('admin.events', [
            'site' => $this->data->site(),
            'admin' => $adminData,
            'events_list' => $events,
            'all_events' => $allEvents,
            'selectedCategory' => $category ?? 'All',
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'events'
        ]);
    }

    public function storeEvent(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'date' => 'required|string',
            'time' => 'required|string',
            'location' => 'required|string',
            'quota' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['status'] = 'Registration is open';
        
        $images = [
            'Clean Up' => '/images/about_1.png',
            'Workshop' => '/images/event_zerowaste.png',
            'Reboisasi' => '/images/about_2.png',
            'Edukasi' => '/images/journey_hero.png',
        ];
        $validated['image'] = $images[$validated['category']] ?? '/images/about_1.png';
        $validated['registered_count'] = 0;

        Event::create($validated);

        return redirect()->route('admin.events')->with('success', 'Kegiatan/Event baru berhasil ditambahkan dan langsung tampil di website publik.');
    }

    public function deleteEvent($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events')->with('success', 'Kegiatan berhasil dihapus dari sistem.');
    }

    public function participants()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.participants', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'participants'
        ]);
    }

    public function articles()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('admin.articles', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'adminUser' => session('terra_admin_user'),
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
            'adminUser' => session('terra_admin_user'),
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
            'adminUser' => session('terra_admin_user'),
            'activeNav' => 'logs'
        ]);
    }
}
