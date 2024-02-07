<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = $data = Category::paginate(3);

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
}
