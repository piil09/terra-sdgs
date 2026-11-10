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

    public function projects()
    {
        return view('admin.projects', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'projects'
        ]);
    }

    public function donations()
    {
        return view('admin.donations', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'donations'
        ]);
    }

    public function users()
    {
        return view('admin.users', [
            'site' => $this->data->site(),
            'admin' => $this->data->get('admin'),
            'activeNav' => 'users'
        ]);
    }

    public function storeProject(Request $request)
    {
        return redirect()->route('admin.projects')->with('success', 'Proyek konservasi baru berhasil ditambahkan.');
    }

    public function deleteProject($id)
    {
        return redirect()->route('admin.projects')->with('success', 'Proyek berhasil dihapus dari sistem.');
    }
}
