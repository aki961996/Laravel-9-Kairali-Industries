<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
use PDF;
use Psy\CodeCleaner\ReturnTypePass;
use Svg\Tag\Rect;

use function PHPSTORM_META\elementType;

class AdminController extends Controller
{
    public function view_category()
    {
        //dd(Auth::id()); null ann so else povum
        //id value undel view page povum

        if (Auth::id()) {
            $data = Category::orderBy('id', 'asc')->paginate(10);
            return view('admin.category', ['category_data' => $data]);
        } else {
            return redirect('login');
        }
    }

    public function add_category(Request $request)
    {

        if (Auth::id()) {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'category' => 'required',

            ]);
            $validated = $validator->validated();
            $validated = $validator->safe()->only(['category']);

            $data = new Category();
            $data->category_name = $request->category;
            $data->save();
            return redirect()->back()->with('message', 'Category Added Successfully');
        } else {
            return redirect('login');
        }
    }

    public function delete_category($id)
    {
        if (Auth::id()) {
            $id = decrypt($id);
            $data = Category::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'Category Deleted Successfully');
        } else {
            return redirect('login');
        }
    }

    public function edit_category($id)
    {
        if (Auth::id()) {
            // $id = decrypt($id);
            // $data = Category::find($id);
            // return view('admin.edit_category', ['edit_category' => $data]);
            $decryptedId = decrypt($id);
            $data = Category::find($decryptedId);
            if (!$data) {
                // Handle the case where the category with the decrypted ID was not found.
                abort(404); // or redirect, or show an error message, etc.
            }
            return view('admin.edit_category', ['edit_category' => $data]);
        } else {
            return redirect('login');
        }
    }


    public function update_category(Request $request)
    {

        if (Auth::id()) {
            $request->validate([
                'category' => 'required',
            ]);

            $id = $request->id;
            $data = Category::find($id);

            if (!empty($data)) {
                $data->category_name = trim($request->category);
                $data->save();
            }
            return redirect()->route('view_category')->with('message', 'Category Updated Successfully');
        } else {
            return redirect('login');
        }
    }

    //products view
    public function view_product()
    {
        if (Auth::id()) {
            // $catagory = new Category();
            $catagory = Category::all();
            return view('admin.product', ['categorys' => $catagory]);
        } else {
            return redirect('login');
        }
    }

    public function add_product(Request $request)
    {

        if (Auth::id()) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'discount_price' => 'required',
                'quantity' => 'required',
                'category' => 'required',
                'image' => 'required'

            ]);
            $validated = $validator->validated();
            //$validated = $validator->safe()->only(['category', 'title']); //This means only that insert in db

            $products = new Product();

            $products->title = $request->title;
            $products->description = $request->description;
            $products->catagory = $request->catagory;
            $products->price = $request->price;
            $products->quantity = $request->quantity;
            $products->discount_price = $request->discount_price;

            //image start
            // $image = $request->image;
            // $imageName = time() . '.' . $image->getClientOriginalExtension();
            // $request->image->move('product', $imageName);
            // $products->image = $imageName;
            //imageend
            // this new method
            if ($request->hasFile('image')) {
                $extension = request('image')->extension();
                $fileName = 'img' . time() . '.' . $extension;
                request('image')->storeAs('product', $fileName);
                $products->image = $fileName;
            }
            // end method
            $products->save();
            return redirect()->back()->with('message', 'Product Addedd Successfully');
        } else {
            return redirect('login');
        }
    }

    public function  show_product()
    {
        if (Auth::id()) {
            //$product_data = Product::all();
            $product_data = Product::orderBy('id', 'asc')->paginate(5);
            return view('admin.show_product', ['products' =>  $product_data]);
        } else {
            return redirect('login');
        }
    }

    //updateproduct metode edit also done
    public function update_product(Request $request, $id)
    {

        if (Auth::id()) {
            $decryptedId = decrypt($id);
            $product = Product::find($decryptedId);
            // catagory table data need there
            $catagory = Category::all();
            return view('admin.update_product', ['product' => $product, 'categories' => $catagory]);
        } else {
            return redirect('login');
        }
    }

    //delete product delete_product
    public function delete_product($id)
    {

        if (Auth::id()) {
            $decryptedId = decrypt($id);
            $product = Product::find($decryptedId);
            $product->delete();
            return redirect()->back()->with('message', 'Product Deleted Successfully');
        } else {
            return redirect('login');
        }
    }

    public function update_product_confirm(Request $request, $id)
    {
        if (Auth::id()) {
            // $request->validate([
            //     'image' => 'required',
            // ]);

            $decryptedId = decrypt($id);
            $product = Product::find($decryptedId);

            $product->title = $request->title;
            $product->description = $request->description;
            $product->catagory = $request->catagory;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->discount_price = $request->discount_price;
            //image start
            // $image = $request->image;
            // $imageName = time() . '.' . $image->getClientOriginalExtension();
            // $request->image->move('product', $imageName);
            // $product->image = $imageName;
            //imageend

            // this is new methode
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete old image
                Storage::delete('product/' . $product->image);
                $extension = request('image')->extension();
                $fileName = 'img' . time() . '.' . $extension;
                request('image')->storeAs('product', $fileName);
                $product->image = $fileName;
            }
            //end 
            $product->save();
            return redirect()->route('show_product')->with('message', 'Product Upadted Successfully');
        } else {
            return redirect('login');
        }
    }

    public function view_order()
    {
        if (Auth::id()) {
            $order = Order::orderBy('id', 'desc')->paginate(10);
            return view('admin.order', ['order' => $order]);
        } else {
            return redirect('login');
        }
    }

    //delivered
    public function delivered(Request $request, $id)
    {
        if (Auth::id()) {
            $order_id = decrypt($request->id);
            $order_table_data_asper_id = Order::find($order_id);
            $order_table_data_asper_id->delivary_status = 'Delivered';
            $order_table_data_asper_id->payment_status = 'Paid';
            $order_table_data_asper_id->save();
            return redirect()->back()->with('message', 'Delivered');
        } else {
            return redirect('login');
        }
    }

    public function print_pdf(Request $request, $id)
    {

        if (Auth::id()) {
            $id = $request->id;
            $decryptedId = decrypt($id);
            $order_datas = Order::find($decryptedId);
            $pdf = FacadePdf::loadView('admin.pdf', ['order_data' => $order_datas]);
            return $pdf->download('order_details.pdf');
        } else {
            return redirect('login');
        }
    }

    public function send_email($id)
    {
        if (Auth::id()) {
            $id = decrypt($id);
            $orderData = Order::find($id);
            return view('admin.email_info', ['orders' => $orderData]);
        } else {
            return redirect('login');
        }
    }

    public function send_user_email(Request $request, $id)
    {

        if (Auth::id()) {
            $decryptedId = decrypt($id);
            $order = Order::find($decryptedId);

            $details = [
                'greeting' => $request->greeting,
                'firstling' => $request->firstling,
                'body' => $request->body,
                'button' => $request->button,
                'url' => $request->url,
                'lastline' => $request->lastline,
            ];

            Notification::send($order, new SendEmailNotification($details));

            return redirect()->back()->with('message', 'Email Sended Successfull');
        } else {
            return redirect('login');
        }
    }

    public function search(Request $request)
    {

        if (Auth::id()) {
            //validation
            // $validator = Validator::make($request->all(), [
            //     'search' => 'required',

            // ]);
            // $validated = $validator->validated();
            // $validated = $validator->safe()->only(['search']);
            //validation

            $searchText = $request->search;  //This search is name in input field
            $order = Order::where('name', 'like', '%' . $searchText . '%')
                ->orWhere('phone', 'like', '%' . $searchText . '%')
                ->orWhere('email', 'like', '%' . $searchText . '%')
                ->orWhere('product_title', 'like', '%' . $searchText . '%')
                ->paginate();
            return view('admin.order', ['order' => $order]);
        } else {
            return redirect('login');
        }
    }
}
