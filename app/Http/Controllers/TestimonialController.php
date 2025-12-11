<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    // 1. [RESELLER] Halaman Tulis Testimoni
    public function create()
    {
        return view('testimonials.create');
    }

    // 2. [RESELLER] Simpan Testimoni
    // 2. [RESELLER] Simpan Testimoni
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:500',
        ]);

        Testimonial::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating, // Ini aman karena tidak ada properti bawaan bernama rating
            // PERBAIKAN DI SINI:
            'content' => $request->input('content'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Terima kasih atas ulasan Anda!');
    }

    // 3. [ADMIN] Lihat Semua Testimoni
    public function index()
    {
        $testimonials = Testimonial::with('user')->latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }
}
