<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        return view('checkout.index', [
            'cart' => $cart,
            'user' => auth()->user()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cod', // Only COD for now as per simplicity or add 'card' if UI supports
        ]);

        $cart = auth()->user()->cart;
        
        if (!$cart || $cart->items->isEmpty()) {
             return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        try {
            DB::beginTransaction();

            // Calculate total
            $total = $cart->items->sum(function($item) {
                return $item->quantity * $item->product->price;
            });

            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->address,
                'phone_number' => $request->phone,
            ]);

            // Create Order Items and Update Stock
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Reduce stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear Cart items
            $cart->items()->delete();
            
            DB::commit();

            return redirect()->route('home')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong while placing your order. Please try again.');
        }
    }
}
