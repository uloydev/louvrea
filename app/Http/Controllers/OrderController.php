<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function myOrder() 
    {
        $orders = Order::where('user_id', Auth::id())->get();

        compact(['orders']);
        return view('my-order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required',
            'phoneNumber' => 'required',
            'fullAddress' => 'required',
            'shippingMethod' => 'required',
        ]);

        dump($request->all());

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        // dd($cartItems);
        if (count($cartItems) == 0) {
            return redirect()->route('cart.index');
        }

        $subTotal = 0;
        $shippingPrice = 10000;

        foreach ($cartItems as $cartItem) {
            $itemPrice = $cartItem->product->price * $cartItem->quantity;
            $subTotal += $itemPrice;
        }

        $order = Order::create([
            'user_id' => $userId,
            'grand_total' => $subTotal+$shippingPrice,
            'order_price' => $subTotal,
            'shipping_price' => $shippingPrice,
            'address' => $request->fullAddress,
            'phone' => $request->phoneNumber,
            'shipping_method' => $request->shippingMethod,
            'status' => OrderStatus::PENDING,
            'full_name' => $request->fullName
        ]);

        OrderItem::insert($cartItems->map(function ($item, $key) use ($userId, $order) {
            return [
                'order_id' => $order->id,
                'user_id' => $userId,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ];
        })->toArray());

        return redirect()->route('order.my-order');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
