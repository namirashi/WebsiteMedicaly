<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('cart.index', compact('carts'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'required|integer|min:1']);
        $cart = Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->increment('quantity', $request->quantity);
        } else {
            Cart::create(['user_id' => auth()->id(), 'product_id' => $request->product_id, 'quantity' => $request->quantity]);
        }
        return response()->json([
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'count' => Cart::where('user_id', auth()->id())->sum('quantity')
        ]);
    }

    public function update(Request $request, $id)
    {
        Cart::where('id', $id)->where('user_id', auth()->id())->update(['quantity' => $request->quantity]);
        return back();
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', auth()->id())->delete();
        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}