<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:500',
        ]);

        // Cek apakah user sudah pernah beli produk ini
        $hasBought = Order::where('user_id', auth()->id())
            ->whereIn('status', ['delivered'])
            ->whereHas('items', function ($q) use ($request) {
                $q->where('product_id', $request->product_id);
            })
            ->exists();

        if (!$hasBought) {
            return back()->with('error', 'Kamu hanya bisa memberi ulasan untuk produk yang sudah dibeli dan diterima.');
        }

        // Cek apakah sudah pernah review produk ini
        $existing = Review::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            // Update review yang sudah ada
            $existing->update([
                'rating'  => $request->rating,
                'comment' => $request->comment,
            ]);
            return back()->with('success', 'Ulasan berhasil diperbarui!');
        }

        // Buat review baru
        Review::create([
            'user_id'    => auth()->id(),
            'product_id' => $request->product_id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan kamu berhasil disimpan.');
    }
}