<?php

namespace App\Http\Controllers;

use App\Models\MarketingKit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketingKitController extends Controller
{
    // 1. Tampilkan Daftar Marketing Kit
    public function index()
    {
        $kits = MarketingKit::all();
        return view('marketing_kits.index', compact('kits'));
    }

    // 2. Form Tambah Baru
    public function create()
    {
        return view('marketing_kits.create');
    }

    // 3. Simpan ke Database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'caption' => 'required',
            // Izinkan jpg, png, mp4, mov (video). Max 20MB (20480 KB)
            'image_path' => 'required|mimes:jpeg,png,jpg,mp4,mov,avi|max:20480',
        ]);

        // Upload File (Kita simpan di folder 'marketing_kits')
        $path = $request->file('image_path')->store('marketing_kits', 'public');

        MarketingKit::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'image_path' => $path,
        ]);

        return redirect()->route('marketing-kits.index')->with('success', 'Bahan promosi berhasil diupload!');
    }
    public function edit(MarketingKit $marketingKit)
    {
        return view('marketing_kits.edit', compact('marketingKit'));
    }

    public function update(Request $request, MarketingKit $marketingKit)
    {
        $request->validate([
            'title' => 'required',
            'caption' => 'required',
            'image_path' => 'nullable|mimes:jpeg,png,jpg,mp4,mov,avi|max:20480',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            // Hapus file lama
            if ($marketingKit->image_path) {
                Storage::disk('public')->delete($marketingKit->image_path);
            }
            // Upload baru
            $data['image_path'] = $request->file('image_path')->store('marketing_kits', 'public');
        }

        $marketingKit->update($data);

        return redirect()->route('marketing-kits.index')->with('success', 'Materi promosi diupdate!');
    }
    // 4. Hapus
    public function destroy(MarketingKit $marketingKit)
    {
        if ($marketingKit->image_path) {
            Storage::disk('public')->delete($marketingKit->image_path);
        }

        $marketingKit->delete();
        return redirect()->route('marketing-kits.index')->with('success', 'Data dihapus!');
    }
}
