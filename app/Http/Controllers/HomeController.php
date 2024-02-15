<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//stripe
// use Session;
use Stripe;

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
            return redirect()->route('show_cart')->with('message', 'Cart Added Successfully');
            // return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    //show_cart
    public function show_cart()
    {

        // HOME PAGE CART CLICK AKUBHOL ID ELLACHAL RETURN TO LOGIN
        if (Auth::id()) {
            $id = Auth::user()->id;
            //login cheyth id vach cartile user_id ayit check akit venam data set akan
            //done
            $cart = Cart::getData($id);
            if ($cart !== null) {
                return view('home.show_cart', ['cart' => $cart]);
            } else {
                return redirect()->back()->with('error', 'Cart not found for the current user.');
            }
        } else {
            return redirect('login');
        }
    }

    //remove cart
    public function remove_cart($id)
    {
        $decryptedId = decrypt($id);
        $cart_remove = Cart::find($decryptedId);
        $cart_remove->delete();
        return redirect()->back()->with('message', 'Cart Removed Successfully');
    }

    //cash_order  cashondelivary
    public function cash_order()
    {
        $user = Auth::user();

        $userId = $user->id;
        $data = Cart::getCartData($userId);
        // dd($data);
        // $data = Cart::where('user_id', $userId)->get();
        foreach ($data as $dataa) {

            $order = new Order();

            $order->name = $dataa->name;
            $order->email = $dataa->email;
            $order->phone = $dataa->phone;
            $order->address = $dataa->address;
            $order->user_id = $dataa->user_id;
            $order->product_id = $dataa->product_id;
            $order->product_title = $dataa->product_title;
            $order->quantity = $dataa->quantity;
            $order->price = $dataa->price;
            $order->image = $dataa->image;
            $order->payment_status = 'cash on delivary';
            $order->delivary_status = 'processing';

            $order->save();

            // order table data save ayi then
            //cart table le same data kal delete akal

            $cart_id = $dataa->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
            //nice
        }

        return redirect()->back()->with('message', 'We Received your Order, We will connect with you soon');
    }


    //totalPrice for stripe
    public function stripe($totalPrice)
    {
        return view('home.stripe', ['totalPrize' => $totalPrice]);
    }

    //stripepost
    public function stripePost(Request $request)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks For Payment."
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
