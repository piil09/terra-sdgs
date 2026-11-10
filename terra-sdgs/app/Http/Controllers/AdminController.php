<?php

namespace App\Http\Controllers;

use App\Services\SiteDataService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(protected SiteDataService $data)
    {
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'dashboard'
        ]);
    }

    public function events()
    {
        return view('admin.events', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
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
            'activeNav' => 'participants'
        ]);
    }

    public function articles()
    {
        return view('admin.articles', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
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
            'activeNav' => 'logs'
        ]);
    }
}
