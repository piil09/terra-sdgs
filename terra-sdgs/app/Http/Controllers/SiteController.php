<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\EventRegistration;
use App\Services\SiteDataService;
use Illuminate\Http\Request;

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

        // Recommendations (other articles)
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

    public function donate()
    {
        return view('pages.donate', [
            'site' => $this->data->site(),
            'donate' => $this->data->get('donate'),
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'donate'
        ]);
    }

    public function storeDonation(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|string',
            'program_name' => 'required|string',
            'amount' => 'required|numeric|min:10000',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'nullable|string|max:50',
            'message' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        Donation::create($validated);

        return redirect()->route('donate')->with('donation_success', [
            'amount' => $validated['amount'],
            'program' => $validated['program_name'],
            'donor' => $validated['donor_name']
        ]);
    }

    public function login()
    {
        return view('pages.login', [
            'site' => $this->data->site(),
            'login' => $this->data->get('login'),
            'cta' => $this->data->get('landing.cta'),
            'assets' => $this->data->assets(),
            'activeNav' => 'login'
        ]);
    }
}
