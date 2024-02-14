<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    }

    public function  show_product()
    {
        //$product_data = Product::all();
        $product_data = Product::orderBy('id', 'asc')->paginate(5);
        return view('admin.show_product', ['products' =>  $product_data]);
    }

    //updateproduct metode edit also done
    public function update_product(Request $request, $id)
    {
        $decryptedId = decrypt($id);
        $product = Product::find($decryptedId);
        // catagory table data need there
        $catagory = Category::all();
        return view('admin.update_product', ['product' => $product, 'categories' => $catagory]);
    }

    //delete product delete_product
    public function delete_product($id)
    {
        $decryptedId = decrypt($id);
        $product = Product::find($decryptedId);
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function update_product_confirm(Request $request, $id)
    {
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
    }
}
