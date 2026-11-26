<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        $cartItems = CartItem::with('product')
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->get();

        $totalWeight = (int) $cartItems->sum('quantity_kg');
        $totalPrice = (int) $cartItems->sum(function ($item) {
            return $item->quantity_kg * ($item->product->price_per_kg ?? 0);
        });

        return view('keranjang', compact('cartItems', 'totalWeight', 'totalPrice'));
    }

    public function add(Request $request): RedirectResponse
    {
        if (! Auth::check()) {
            session()->put('url.intended', route('produk'));

            return redirect()->route('login')->with('error', 'Silakan masuk atau daftar akun terlebih dahulu untuk memesan produk tembakau.');
        }

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity_kg' => ['nullable', 'integer', 'min:1'],
        ], [
            'product_id.required' => 'Produk tembakau wajib dipilih.',
            'product_id.exists' => 'Produk tembakau yang dipilih tidak ditemukan.',
            'quantity_kg.integer' => 'Jumlah kuantitas harus berupa angka bulat.',
            'quantity_kg.min' => 'Jumlah pesanan minimal 1 Kg.',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $qty = (int) $request->input('quantity_kg', 1);

        $cartItem = CartItem::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity_kg', $qty);
        } else {
            CartItem::create([
                'user_id' => $userId,
                'session_id' => null,
                'product_id' => $productId,
                'quantity_kg' => $qty,
            ]);
        }

        return redirect()->route('keranjang')->with('status', 'Produk tembakau berhasil ditambahkan ke keranjang belanja!');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $this->authorizeCartItem($cartItem);

        $request->validate([
            'quantity_kg' => ['required', 'integer', 'min:1'],
        ], [
            'quantity_kg.required' => 'Jumlah kuantitas wajib diisi.',
            'quantity_kg.integer' => 'Jumlah kuantitas harus berupa angka bulat.',
            'quantity_kg.min' => 'Jumlah pesanan minimal 1 Kg.',
        ]);

        $cartItem->update([
            'quantity_kg' => $request->quantity_kg,
        ]);

        return back()->with('status', 'Jumlah pesanan berhasil diperbarui.');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        return back()->with('status', 'Item tembakau berhasil dihapus dari keranjang.');
    }

    protected function authorizeCartItem(CartItem $cartItem): void
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        $isOwner = false;
        if ($userId && $cartItem->user_id === $userId) {
            $isOwner = true;
        } elseif (! $userId && $cartItem->session_id === $sessionId) {
            $isOwner = true;
        }

        if (! $isOwner) {
            abort(403, 'Akses ditolak: Anda tidak memiliki akses ke item keranjang ini.');
        }
    }
}
