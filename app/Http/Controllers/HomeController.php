<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
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
}
