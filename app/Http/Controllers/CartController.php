<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.product')->first();
        
        // Calculate total
        $total = 0;
        if ($cart) {
            foreach ($cart->items as $item) {
                $total += $item->price * $item->quantity;
            }
        }

        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        // Get or create cart
        $cart = $user->cart()->firstOrCreate([
            'user_id' => $user->id
        ]);

        // Check if item already exists in cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cart_count' => $cart->items()->sum('quantity')
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Ensure user owns this cart item
        if ($item->cart->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $item->quantity = $request->quantity;
        $item->save();
        
        // Recalculate total for response
        $cart = $item->cart;
        $total = 0;
        foreach ($cart->items as $cartItem) {
            $total += $cartItem->price * $cartItem->quantity;
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'item_total' => $item->price * $item->quantity,
            'cart_total' => $total,
            'cart_count' => $cart->items()->sum('quantity')
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function remove(CartItem $item)
    {
        // Ensure user owns this cart item
        if ($item->cart->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $cart = $item->cart;
        $item->delete();
        
        // Recalculate total for response
        $total = 0;
        foreach ($cart->items as $cartItem) {
            $total += $cartItem->price * $cartItem->quantity;
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed',
            'cart_total' => $total,
            'cart_count' => $cart->items()->sum('quantity')
        ]);
    }
    
    /**
     * Get cart count for header
     */
    public function count()
    {
        $count = 0;
        if (Auth::check()) {
            $cart = Auth::user()->cart;
            if ($cart) {
                $count = $cart->items()->sum('quantity');
            }
        }
        
        return response()->json(['count' => $count]);
    }
}
