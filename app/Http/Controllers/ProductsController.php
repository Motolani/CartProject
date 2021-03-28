<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();

        return view('products', compact("products"));
    }

    public function addProductToCart(Request $request, $id)
    {
        // $request->session()->forget("cart");
        // $request->session()->flush();

        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id, $product);

        //storing the added item in the session
        $request->session()->put('cart', $cart);
        return redirect()->route('Products');
    }

    public function showCartProducts()
    {
        $cart = Session::get('cart');

        if ($cart) {
            return view('cart', ['cartItems' => $cart]);
        } else {
            return redirect()->route('Products');
        }
    }

    public function deleteCartItem(Request $request, $id)
    {
        //grabbing the item from the session
        $cart = $request->session()->get('cart');

        //deleting the item
        if (array_key_exists($id, $cart->items)) {
            unset($cart->items[$id]);
        }

        //going to create a new and updated cart and saving it in the session
        //first going to create a new cart object
        $prevCart = $request->session()->get('cart');
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriceAndQuantity();

        //putting it back into the session
        $request->session()->put('cart', $updatedCart);

        //redirecting back to the cart after deleting item
        return redirect()->route('cartProducts');
    }
}
