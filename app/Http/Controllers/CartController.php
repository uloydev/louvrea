<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        $grandTotal = 0;

        foreach ($cartItems as $cartItem) {
            $subtotal = $cartItem->product->price * $cartItem->quantity;
            $grandTotal += $subtotal;
        }
        return view('cart', [
            'items' => $cartItems,
            'grandTotal' => $grandTotal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric|min:1',
            'quantity' =>'required|numeric|min:1',
        ]);
        $cart = new Cart;
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'value' => 'required|numeric'
        ]);
        $value = $request->value;
        if ($cart->quantity == 1 and $value == -1) {
            $cart->delete();
        } else {
            $cart->quantity += $value;
            $cart->save();
        }
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index');
    }

    public function checkoutSummary(Request $request) {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        if (count($cartItems) == 0) {
            return redirect()->route('cart.index');
        }
        $subTotal = 0;
        $shippingPrice = 10000;

        foreach ($cartItems as $cartItem) {
            $itemPrice = $cartItem->product->price * $cartItem->quantity;
            $subTotal += $itemPrice;
        }
        return view('checkout', [
            'shipping_methods' => [
                'KURIR TOKO'
            ],
            'jabodetabek' => Regency::whereIn('id', Regency::jabodetabek)->get(),
            'shipping' => $shippingPrice,
            'items' => $cartItems,
            'subTotal' => $subTotal,
            'grandTotal' => $subTotal + $shippingPrice,
        ]);
    }
}
