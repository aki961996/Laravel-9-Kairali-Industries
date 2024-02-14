<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $product = Product::orderBy('id', 'asc')->paginate(6);
        return view('home.userpage', ['product' => $product]);
    }


    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        // dd($usertype);
        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $product = Product::orderBy('id', 'asc')->paginate(6);
            return view('home.userpage', ['product' => $product]);
        }
    }

    //show product details
    public function product_detail($id)
    {
        $decryptedId = decrypt($id);
        $product = Product::find($decryptedId);

        return view('home.product_details', ['product' => $product]);
    }

    // add_cart
    public function add_cart(Request $request, $id)
    {
        // dd(Auth::id());  right now null ann vara the go to else part
        $id = decrypt($id);

        if (Auth::id()) {
            $user = Auth::user();

            $product = Product::find($id);

            $cart = new Cart();

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;

            // means discount undel ah price kerum else ellacha price kerum

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }


            $cart->quantity = $product->quantity;
            $cart->image = $product->image;
            $cart->product_id = $product->id;

            $cart->quantity = $request->quantity;

            $cart->save();
            // return redirect()->back()->with('message', 'Cart Added Successfully');
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
}
