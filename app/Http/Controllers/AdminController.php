<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::orderBy('id', 'asc')->paginate(10);
        return view('admin.category', ['category_data' => $data]);
    }

    public function add_category(Request $request)
    {
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
    }

    public function delete_category($id)
    {
        $id = decrypt($id);
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function edit_category($id)
    {
        $id = decrypt($id);
        $data = Category::find($id);
        return view('admin.edit_category', ['edit_category' => $data]);
    }


    public function update_category(Request $request)
    {
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
    }

    //products view
    public function view_product()
    {
        // $catagory = new Category();
        $catagory = Category::all();
        return view('admin.product', ['categorys' => $catagory]);
    }

    public function add_product(Request $request)
    {

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
        $products->catagory = $request->category;
        $products->price = $request->price;
        $products->quantity = $request->quantity;
        $products->discount_price = $request->title;

        //image start
        $image = $request->image;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imageName);
        $products->image = $imageName;
        //imageend


        $products->save();
        return redirect()->back()->with('message', 'Product Addedd Successfully');
    }

    public function  show_product()
    {

        $product_data = Product::all();
        return view('admin.show_product', ['products' =>  $product_data]);
    }

    public function edit_product(Request $request, $id)
    {
        // dd($request->id);

        $id = decrypt($id);
        $data = Product::find($id);
        return view('admin.edit_product', ['product' => $data]);
    }
}
