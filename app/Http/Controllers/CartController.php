<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function shop()
    {
        $products = Product::all();
        return view('cart.shop', compact('products'));
    }

    public function cart()
    {
        // dd(Cart::content());
        return view('cart.cart');
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        // dd($product);
        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => 1, 
            'price' => $product->price, 
            'weight' => 550, 
            'options' => [
                'image' => $product->image
                ]
            ]);

        return redirect()->back()->with('success', 'Product is added into the cart!');
    }

    public function qtyIncrement($id)
    {
        // dd($id);

        $product = Cart::get($id);
        $updateQty = $product->qty + 1;
        Cart::update($id, $updateQty);
        // dd($updateQty);
        return redirect()->back()->with('success', 'Product is successfully increment!');
    }

    public function qtyDecrement($id)
    {
        // dd($id);
        $product = Cart::get($id);
        $updateQty = $product->qty - 1;

        if($updateQty > 0){
            Cart::update($id, $updateQty);
            return redirect()->back()->with('success', 'Product is successfully decrement!');
        }
        // dd($updateQty);
        return redirect()->back()->with('success', 'Minimum quantity is 1!');

    }

    public function removeProduct($id)
    {
        Cart::remove($id);

        return redirect()->back()->with('success', 'Product is successfully deleted!');
    }
}
