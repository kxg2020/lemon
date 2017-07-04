<?php

namespace APP\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __controller()
    {
        return $this->middleware('dashboard');
    }

    public function index()
    {
        return view('dashboard.index');
    }

}