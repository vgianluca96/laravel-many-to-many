<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $admin_user = User::find($id = 1);

        return view('admin.dashboard', compact('admin_user'));
    }
}
