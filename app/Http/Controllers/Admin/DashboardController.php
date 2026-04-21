<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\SystemLog;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}