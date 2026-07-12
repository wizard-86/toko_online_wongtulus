<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Tampilkan isi keranjang belanja.
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->with('cartItems.product.category')
                    ->first();

        $cartItems = $cart ? $cart->cartItems : collect();
        $total = $cartItems->sum('subtotal');

        return view('shop.cart', compact('cartItems', 'total'));
    }

    /**
     * Tambahkan produk ke keranjang.
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->subtotal = $cartItem->quantity * $product->price;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'quantity'   => $quantity,
                'subtotal'   => $quantity * $product->price,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update quantity item di keranjang.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        // Pastikan cart item milik user yang sedang login
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cartItem->cart_id !== $cart->id) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $product = $cartItem->product;

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $product->stock);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->subtotal = $request->quantity * $product->price;
        $cartItem->save();

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Hapus item dari keranjang.
     */
    public function destroy(CartItem $cartItem)
    {
        // Pastikan cart item milik user yang sedang login
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cartItem->cart_id !== $cart->id) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
