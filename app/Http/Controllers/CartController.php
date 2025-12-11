<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Lihat Keranjang
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('carts.index', compact('carts'));
    }

    // Tambah ke Keranjang
    public function store(Request $request, Product $product)
    {
        // UBAH VALIDASI: Minimal 20
        $request->validate([
            'quantity' => 'required|integer|min:20'
        ], [
            'quantity.min' => 'Minimal pembelian untuk Reseller adalah 20 pcs per item!'
        ]);

        // Cek stok
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak cukup!');
        }

        // Cek apakah produk sudah ada di keranjang
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('carts.index')->with('success', 'Berhasil masuk keranjang (Min. 20 pcs)');
    }

    // Hapus dari Keranjang
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
