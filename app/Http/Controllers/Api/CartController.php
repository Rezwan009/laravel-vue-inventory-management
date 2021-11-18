<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $data = array();
        $quantity = 1;
        $isCart = Cart::where('product_id', $id)->first();
        if ($isCart) {
            Cart::where('product_id', $id)->increment('product_qty');
            $product = Cart::where('product_id', $id)->first();
            $subTotal = $product->product_price * $product->product_qty;
            $product->update(['sub_total' => $subTotal]);
        } else {
            $data['product_id'] = $product->id;
            $data['product_name'] = $product->name;
            $data['product_qty'] = $quantity;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;
            $cart  = Cart::create($data);
            if ($cart) {
                return response()->json(['cart' => $cart]);
            } else {
                return response()->json(['error' => 'Unable to add product to cart']);
            }
        }
    }
    public function incrementCartItem($id)
    {
        $cart = Cart::where('id', $id)->increment('product_qty');
        if ($cart) {
            # code...
            $product = Cart::where('id', $id)->first();
            $subTotal = $product->product_price * $product->product_qty;
            $product->update(['sub_total' => $subTotal]);
            return response()->json(['product' => $product]);
        } else {
            return response()->json(['error' => 'Unable to increment product']);
        }
    }
    public function decrementCartItem($id)
    {
        $cart = Cart::where('id', $id)->decrement('product_qty');
        if ($cart) {
            # code...
            $product = Cart::where('id', $id)->first();
            $subTotal = $product->product_price * $product->product_qty;
            $product->update(['sub_total' => $subTotal]);
            return response()->json(['product' => $product]);
        } else {
            return response()->json(['error' => 'Unable to increment product']);
        }
    }
    public function allCartProducts()
    {
        $carts = Cart::all();
        return response()->json($carts);
    }
    public function removeCartItem($id)
    {
        Cart::findOrFail($id)->delete();
        return response()->json(['success' => 'Remove product from cart successfuly done']);
    }
}
