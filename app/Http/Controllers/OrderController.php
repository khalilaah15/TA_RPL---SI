<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cart;

class OrderController extends Controller
{
    // 1. Tampilkan Halaman Belanja
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();

        // TAMBAHAN: Hitung jumlah jenis barang di keranjang user saat ini
        $cartTypes = Cart::where('user_id', Auth::id())->count();

        // Kirim variable $cartTypes ke view menggunakan compact
        return view('orders.index', compact('products', 'cartTypes'));
    }

    // 2. Proses Checkout (REVISI)
    public function store(Request $request)
    {
        // A. Validasi Input Lengkap
        $request->validate([
            'receiver_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'payment_proof' => 'required|image|max:2048', // Wajib upload bukti
        ]);

        // B. Ambil semua isi keranjang user
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // C. LOGIKA BARU: Cek Minimal 20 PCS & HITUNG TOTAL HARGA
        $totalAmount = 0; // Inisialisasi variabel

        foreach ($carts as $item) {
            // Cek MOQ
            if ($item->quantity < 20) {
                return back()->with('error', 'Produk "' . $item->product->name . '" masih kurang dari 20 pcs. Silakan tambah lagi.');
            }

            // Hitung Total Harga (Harga x Jumlah)
            $totalAmount += $item->product->price * $item->quantity;
        }

        // D. Upload Bukti Bayar
        $proofPath = $request->file('payment_proof')->store('payments', 'public');

        // E. Mulai Transaksi Database
        // Kita passing $totalAmount yang sudah dihitung di atas
        DB::transaction(function () use ($request, $carts, $totalAmount, $proofPath) {

            // Buat Transaksi
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount, // INI YANG TADI SALAH
                'status' => 'pending',
                'receiver_name' => $request->receiver_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'note' => $request->note,
                'payment_proof' => $proofPath,
            ]);

            // Pindahkan isi Cart ke TransactionDetail & Kurangi Stok
            foreach ($carts as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Kurangi stok
                $item->product->decrement('stock', $item->quantity);
            }

            // Kosongkan Keranjang
            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('order.history')->with('success', 'Pesanan berhasil! Menunggu konfirmasi admin.');
    }

    // 3. Reseller Terima Barang
    public function markAsCompleted(Transaction $transaction)
    {
        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }

        $transaction->update(['status' => 'completed']);
        return back()->with('success', 'Terima kasih! Pesanan selesai.');
    }

    // 4. Halaman Riwayat Pesanan
    public function history()
    {
        // Ambil transaksi milik user yang login, urutkan dari yang terbaru
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('details.product') // Load juga detail produknya
            ->latest()
            ->get();

        return view('orders.history', compact('transactions'));
    }

    // 5. Download Invoice PDF
    public function invoice(Transaction $transaction)
    {
        // Keamanan: Pastikan yang download adalah pemilik transaksi
        if ($transaction->user_id != Auth::id()) {
            abort(403, 'Anda tidak berhak melihat invoice ini.');
        }

        // Load tampilan PDF
        $pdf = Pdf::loadView('orders.invoice', compact('transaction'));

        // Download file
        return $pdf->download('invoice-umkm-' . $transaction->id . '.pdf');
    }

    public function getOrderDetail($id)
    {
        $transaction = Transaction::with(['details.product']) // Load relasi details & product
            ->where('id', $id)
            ->where('user_id', Auth::id()) // Pastikan hanya pemilik yang bisa lihat
            ->firstOrFail();

        // Format response sesuai kebutuhan JavaScript renderOrderDetail
        return response()->json([
            'id' => $transaction->id,
            'order_code' => $transaction->order_code ?? $transaction->id,
            'created_at' => $transaction->created_at,
            'status' => $transaction->status,
            'total_amount' => $transaction->total_amount,
            'receiver_name' => $transaction->receiver_name,
            'phone' => $transaction->phone,
            'address' => $transaction->address,
            'note' => $transaction->note,
            'payment_proof' => $transaction->payment_proof ? asset('storage/' . $transaction->payment_proof) : null,
            // Mapping details ke format items yg diminta JS
            'items' => $transaction->details->map(function ($item) {
                return [
                    'product_name' => $item->product->name,
                    'product_image' => asset('storage/' . $item->product->image),
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }),
        ]);
    }
}
