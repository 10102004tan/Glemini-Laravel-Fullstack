<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    // Hiển thị trang dashboard
    public function showDashboard()
    {
        return view("dashboard.index");
    }
}
