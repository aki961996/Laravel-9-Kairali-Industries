<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use App\Models\User;
use Exception;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Psy\CodeCleaner\ReturnTypePass;
// use Illuminate\Support\Facades\Session;
//stripe
// use Session;
use Stripe;
use Stripe\Stripe as StripeStripe;
use Stripe\Token;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Svg\Tag\Rect;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    public function index()
    {
        $product = Product::orderBy('id', 'asc')->paginate(7);
        // $comments = Comment::orderBy('created_at', 'desc')->get();
        // $reply = Reply::orderBy('created_at', 'desc')->get();
        return view('home.userpage', ['product' => $product]);
    }


    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        // dd($usertype);
        if ($usertype == '1') {


            $total_products = Product::all()->count();
            $total_orders = Order::all()->count();
            $total_users = User::all()->count();

            $order = Order::all();
            $total_revenue = 0;
            foreach ($order as $orders) {
                $total_revenue = $total_revenue + $orders->price;
            }

            $total_delivered = Order::where('delivary_status', '=', 'Delivered')->get()->count();

            $total_processing = Order::where('delivary_status', '=', 'processing')->get()->count();

            return view('admin.home', ['total_products' => $total_products, 'total_orders' => $total_orders, 'total_users' => $total_users, 'total_revenue' => $total_revenue, 'total_deliverd' => $total_delivered, 'total_processing' => $total_processing]);
        } else {
            $product = Product::orderBy('id', 'asc')->paginate(6);
            // $comments = Comment::orderBy('created_at', 'desc')->get();
            // $reply = Reply::orderBy('created_at', 'desc')->get();

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
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::find($id);

            if ($product) {
                $cart_existing = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

                if ($cart_existing) {
                    $newQuantity = $cart_existing->quantity + $request->quantity;
                    $cart_existing->update(['quantity' => $newQuantity]);
                } else {
                    $cart = new Cart();
                    $cart->user_id = $user->id;
                    $cart->name = $user->name;
                    $cart->email = $user->email;
                    $cart->phone = $user->phone;
                    $cart->address = $user->address;

                    $cart->product_title = $product->title;

                    // Use the null coalescing operator to simplify the price assignment
                    $cart->price = $product->discount_price ?? $product->price;
                    $cart->quantity = $product->quantity;
                    $cart->image = $product->image;
                    $cart->product_id = $product->id;

                    // You might want to use the request data instead of hardcoded quantity
                    $cart->quantity = $request->quantity ?? 1;

                    $cart->save();
                    Alert::success('Product Added Successfully', 'We have addedd product to the cart');
                    return redirect()->back();
                    // return redirect()->back()->with('message', 'Product Added Successfully');
                }
            }
            // return redirect()->route('show_cart')->with('message', 'Cart Added Successfully');
            // return redirect()->back();
            return redirect()->back()->with('message', 'Product Added Successfully');
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
    public function charge_stripe()
    {
        return view('home.stripe');
    }

    public function  checkout()
    {
        // dd($totalPrize);
        $user = Auth::user();
        $userId = $user->id;
        $cart = Cart::getCartData($userId);
        $line_items = [];
        foreach ($cart as $dataa) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => $dataa['product_title'],
                    ],
                    'unit_amount' => $dataa['price'] * 100,
                ],
                'quantity' => $dataa['quantity'],
            ];
        }


        \Stripe\Stripe::setApiKey(config(key: 'stripe.sk'));
        $session = \Stripe\Checkout\Session::create([

            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('charge_stripe'),

        ]);


        return redirect()->away($session->url);
    }

    public function success()
    {
        'hey its work';
    }

    //show_order

    public function show_order()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $order = Order::where('user_id', $id)->get();

            if ($order !== null) {
                return view('home.show_order', ['order' => $order]);
            } else {

                return redirect()->back()->with('error', 'Order not found for the current user.');
            }
        } else {
            return redirect('login');
        }
    }


    //remove_order
    public function  remove_order($id)
    {
        $decryptedId = decrypt($id);
        $order = Order::find($decryptedId);
        // $makeTheText = Order::makeTextBold('YOU CANCELED THE ORDER');
        $order->delivary_status = 'YOU CANCELED THE ORDER';
        $order->save();
        return redirect()->back()->with('message', 'Order Canceled Successfully and just visit Delivary Status!!!');
    }

    // public function comment_add(Request $request)
    // {
    //     // dd(Auth::user());
    //     if (Auth::id()) {
    //         // The user is authenticated
    //         $comment = new Comment();
    //         $comment->name = Auth::user()->name;
    //         $comment->comment = $request->comment;
    //         $comment->user_id = Auth::user()->id;
    //         $comment->save();
    //         // return redirect()->back()->with('message', 'Comment Addedd Successfully');
    //         return redirect()->back();
    //     } else {
    //         // The user is not authenticated
    //         return redirect('login');
    //         // return response()->json(['message' => 'User not authenticated'], 401);
    //     }
    // }

    //reply_comment
    // public function add_reply(Request $request)
    // {
    //     if (Auth::id()) {
    //         $reply = new Reply();
    //         $reply->name = Auth::user()->name;
    //         $reply->comment_id = $request->commentId;
    //         $reply->user_id = Auth::user()->id;
    //         $reply->reply = $request->reply;
    //         $reply->save();
    //         return redirect()->back();
    //     } else {
    //         // The user is not authenticated
    //         return redirect('login');
    //     }
    // }

    //product product_search 
    public function product_search(Request $request)
    {
        $search_text = $request->search;
        $products = Product::where('title', 'LIKE', '%' . $search_text . '%')
            ->orWhere('catagory', 'LIKE', '%' . $search_text . '%')
            ->paginate(7);
        return view('home.userpage', ['product' => $products]);
    }

    public function products()
    {
        $product = Product::orderBy('id', 'asc')->paginate(7);
        return view('home.all_products', ['product' => $product]);
    }

    //serarch product  product tab click and serch this
    public function search_product(Request $request)
    {
        $search_text = $request->search;
        $products = Product::where('title', 'LIKE', '%' . $search_text . '%')
            ->orWhere('catagory', 'LIKE', '%' . $search_text . '%')
            ->paginate(7);
        return view('home.all_products', ['product' => $products]);
    }

    //contactpage
    public function contact()
    {
        return view('home.contact');
    }

    //contact form store
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',

        ]);
        $validated = $validator->validated();
        $contact = new Contact();

        if (Auth::id()) {
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->user_id = Auth::user()->id;
            $contact->save();
            Alert::success('Hey User', 'Thanks for contacting us. We will connect you!');
            // return redirect()->back()->with('success', 'Thanks for contacting us. We will connect you!!!');
            return redirect()->back();
        } else {

            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->user_id = "Not Logged";
            $contact->save();
            Alert::success('Hey User', 'We will connect you!');
            return redirect()->back();
        }
    }
}
