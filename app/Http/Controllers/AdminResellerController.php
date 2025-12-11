<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminResellerController extends Controller
{
    public function index()
    {
        $resellers = User::where('role', 'reseller')->latest()->get();
        return view('admin.resellers.index', compact('resellers'));
    }
}