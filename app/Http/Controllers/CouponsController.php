<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupons::where('code', $request->coupon_code)->first();
        //to check if it works
        //dd($coupon);

        $cart = $request->session()->get('cart');
        $totalPrice = $cart->totalPrice;

        if (!$coupon) {
            return redirect()->route('cartProducts')->with('error_message', 'Invalid Coupon, Please Try again');
        } else {
            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $coupon->discount($totalPrice)
            ]);
            return redirect()->route('cartProducts')->with('success_message', 'Coupon has been applied');
            //$request->session()->forget("coupon");
            //$request->session()->flush();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return redirect()->route('cartProducts')->with('success_message', 'Coupon has been removed');
    }
}
