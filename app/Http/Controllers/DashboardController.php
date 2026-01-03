<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin'    => $this->adminDashboard(),
            'partner'  => $this->partnerDashboard(),
            'customer' => $this->customerDashboard(),
            default    => abort(403),
        };
    }

    protected function adminDashboard()
    {
        return view('dashboard.admin');
    }

    protected function partnerDashboard()
    {
        return view('dashboard.partner');
    }

    protected function customerDashboard()
    {
        return view('dashboard.customer');
    }
}
