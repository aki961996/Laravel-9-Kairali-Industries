<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 34px;
            padding-bottom: 40px;
        }

        .text_color {
            color: black;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')

        {{-- products body part --}}
        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif
                
                <form action="{{route('add_product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="div_center">
                        <h2 class="h2_font">Add Products</h2>
                        <div class="div_design">
                            <label>Product Title :</label>
                            <input type="text" class="text_color" name="title" placeholder="Write A Title">
                            <div class="error_style" style="color: red">{{$errors->first('title')}}</div>
                        </div>

                        <div class="div_design">
                            <label>Product description:</label>
                            <input type="text" class="text_color" name="description" placeholder="Write A description">
                            <div class="error_style" style="color: red">{{$errors->first('description')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product price:</label>
                            <input type="number" class="text_color" name="price" placeholder="Write A price">
                            <div class="error_style" style="color: red">{{$errors->first('price')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product discount price:</label>
                            <input type="number" class="text_color" name="discount_price"
                                placeholder="Write A discount price">
                            <div class="error_style" style="color: red">{{$errors->first('discount_price')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product quantity:</label>
                            <input type="number" class="text_color" min="0" name="quantity"
                                placeholder="Write A quantity">
                            <div class="error_style" style="color: red">{{$errors->first('quantity')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product Category:</label>
                            <select class="text_color" name="category">
                                <option value="" selected="">Add A Category</option>
                                @foreach($categorys as $catagory)
                                <option value="{{$catagory->category_name}}">{{$catagory->category_name}}</option>
                                @endforeach
                                <div class="error_style" style="color: red">{{$errors->first('category')}}</div>
                            </select>
                        </div>
                        <div class="div_design">
                            <label>Product Image:</label>
                            <input type="file" name="image" placeholder="" />
                            <div class="error_style" style="color: red">{{$errors->first('image')}}</div>
                        </div>
                        <div class="div_design">
                            <input type="submit" value="Add Products" class="btn btn-primary">

                        </div>

                    </div>
                </form>
            </div>



        </div>

    </div>
    </div>

    @include('admin.script')

</body>

</html>