<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // 1. Lihat Semua Pesanan Masuk
    public function index()
    {
        // Ambil semua transaksi, urutkan dari yang terbaru
        // Kita juga load data 'user' (pembeli) dan 'details' (produk yg dibeli)
        $transactions = Transaction::with(['user', 'details.product'])->latest()->get();
        
        return view('admin.orders.index', compact('transactions'));
    }

    // 2. Update Status Pesanan (Pending -> Lunas/Dikirim)
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled'
        ]);

        $transaction->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // ... method index dan update sudah ada sebelumnya ...

    // 3. (BARU) Lihat Detail Lengkap Pesanan
    public function show(Transaction $transaction)
    {
        // Pastikan kita load relasi user dan produk agar hemat query
        $transaction->load(['user', 'details.product']);
        
        return view('admin.orders.show', compact('transaction'));
    }
}