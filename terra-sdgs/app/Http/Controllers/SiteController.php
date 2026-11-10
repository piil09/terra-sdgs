<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use App\Models\User;
use App\Services\SiteDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function __construct(protected SiteDataService $data)
    {
    }

    public function home()
    {
        return view('pages.home', [
            'site' => $this->data->site(),
            'landing' => $this->data->get('landing'),
            'events' => $this->data->events(),
            'articles' => array_slice($this->data->articles(), 0, 3),
            'assets' => $this->data->assets(),
            'activeNav' => 'home'
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'site' => $this->data->site(),
            'about' => $this->data->get('about'),
            'goals' => $this->data->get('landing.goals'),
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'about'
        ]);
    }

    public function events()
    {
        return view('pages.events', [
            'site' => $this->data->site(),
            'events' => $this->data->events(),
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'events'
        ]);
    }

    public function registerEvent(Request $request)
    {
        $selectedEventId = $request->query('event_id');
        $selectedEvent = $selectedEventId ? $this->data->event((int)$selectedEventId) : null;

        return view('pages.register_event', [
            'site' => $this->data->site(),
            'registration' => $this->data->get('registration'),
            'selectedEvent' => $selectedEvent,
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'events'
        ]);
    }

    public function storeEventRegistration(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'date_of_birth' => 'nullable|string|max:50',
            'city' => 'required|string|max:100',
            'occupation' => 'required|string|max:100',
            'gender' => 'required|string',
            'interest' => 'required|string',
            'volunteer_experience' => 'nullable|string',
        ]);

        EventRegistration::create($validated);

        return redirect()->route('events.register')->with('success', 'Selamat! Pendaftaran relawan Anda berhasil dicatat. Tim Terra akan menghubungi Anda melalui WhatsApp/Email.');
    }

    public function articles(Request $request)
    {
        $category = $request->query('category', 'All');
        $allArticles = $this->data->articles();

        if ($category !== 'All' && !empty($category)) {
            $filtered = array_filter($allArticles, function ($art) use ($category) {
                return strtolower($art['category']) === strtolower($category);
            });
        } else {
            $filtered = $allArticles;
        }

        return view('pages.articles', [
            'site' => $this->data->site(),
            'articles' => array_values($filtered),
            'currentCategory' => $category,
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'articles'
        ]);
    }

    public function articleDetail(string $slug)
    {
        $article = $this->data->article($slug);

        if (!$article) {
            $article = $this->data->articles()[0];
        }

        $recommendations = array_filter($this->data->articles(), function ($a) use ($article) {
            return $a['id'] !== $article['id'];
        });

        return view('pages.article_detail', [
            'site' => $this->data->site(),
            'article' => $article,
            'recommendations' => array_slice(array_values($recommendations), 0, 3),
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'articles'
        ]);
    }

    /**
     * Show Regular User Login Page
     */
    public function login()
    {
        // If already has valid regular user token, redirect to profile
        if (session('terra_user_token') && session('terra_user_role') === 'user') {
            return redirect()->route('user.profile');
        }

        return view('pages.login', [
            'site' => $this->data->site(),
            'login' => $this->data->get('login'),
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'login'
        ]);
    }

    /**
     * Process Regular User Login (strictly user credentials)
     */
    public function processUserLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        // Must be a regular user
        if ($user && $user->role === 'user' && Hash::check($password, $user->password)) {
            // Generate distinct user token
            $userToken = 'usr_' . Str::random(40);

            // Set exclusive user session variables
            session([
                'terra_user_token' => $userToken,
                'terra_user_role' => 'user',
                'terra_user_data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => 'Volunteer / Member'
                ]
            ]);

            return redirect()->route('user.profile')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        // If user exists but is an admin trying to login via public user portal
        if ($user && $user->role === 'admin') {
            return back()->with('error', 'Akses ditolak: Akun ini adalah Administrator. Silakan login melalui Portal Admin di /admin/login.');
        }

        return back()->with('error', 'Kombinasi email atau kata sandi tidak sesuai.');
    }

    /**
     * Regular User Profile / Dashboard Area
     */
    public function userProfile()
    {
        $userData = session('terra_user_data');
        $myRegistrations = EventRegistration::where('email', $userData['email'] ?? '')->get();

        return view('pages.profile', [
            'site' => $this->data->site(),
            'user' => $userData,
            'registrations' => $myRegistrations,
            'events' => $this->data->events(),
            'activeNav' => 'profile'
        ]);
    }

    /**
     * Regular User Logout
     */
    public function userLogout()
    {
        session()->forget(['terra_user_token', 'terra_user_role', 'terra_user_data']);
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
