<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role == 'kurir') {
            return redirect()->route('kurir.dashboard');
        } else {
            // Default ke pelanggan
            return redirect()->route('pelanggan.dashboard');
        }
    }
}