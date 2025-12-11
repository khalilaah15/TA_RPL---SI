<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $data = [];

        if ($user->role === 'admin') {
            // --- DATA UNTUK ADMIN ---
            $data['total_revenue'] = Transaction::where('status', 'completed')->sum('total_amount');
            $data['pending_orders'] = Transaction::where('status', 'pending')->count();
            $data['completed_orders'] = Transaction::where('status', 'completed')->count();
            $data['total_users'] = User::where('role', 'reseller')->count();
            // Ambil 5 transaksi terbaru dari semua user
            $data['recent_orders'] = Transaction::with('user')->latest()->take(5)->get();
        } else {
            // --- DATA UNTUK RESELLER ---
            $data['total_spent'] = Transaction::where('user_id', $user->id)
                                    ->where('status', 'completed')
                                    ->sum('total_amount');
            $data['active_orders'] = Transaction::where('user_id', $user->id)
                                    ->whereIn('status', ['pending', 'paid', 'processing', 'shipped'])
                                    ->count();
            $data['completed_orders_count'] = Transaction::where('user_id', $user->id)
                                    ->where('status', 'completed')
                                    ->count();
            $data['cart_count'] = Cart::where('user_id', $user->id)->sum('quantity');
            // Ambil 5 transaksi terbaru milik user ini
            $data['recent_orders'] = Transaction::where('user_id', $user->id)->latest()->take(5)->get();
        }

        return view('dashboard', compact('data'));
    }
}