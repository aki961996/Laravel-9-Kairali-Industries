<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="/public">

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

        /* .img_size {
            text-align: left;
            width: 50%;
            margin-left: auto;
        } */

        .img_css {
            width: 100px;
            height: 90px;
            object-fit: cover;
            /* margin-bottom: 10px; */
            display: inline-block;
            margin: auto;
        }

        .h5_css {
            text-align: center;
            color: rgb(253, 193, 119);
            font-size: 13px;
            line-height: 25px;
            margin-bottom: 7px;

        }

        .h5_css i {
            color: white;
            margin-right: 7px;
            font-size: 20px;
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

                <div class="col-sm-12" style="text-align: right">
                    <a href="{{url('show_product')}}" class="btn btn-primary">Back</a>
                </div>

                <form action="{{route('update_product_confirm', encrypt($product->id))}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="id" value="{{$product->id}}" class="form-control" id=""
                        placeholder=""> --}}
                    <div class="div_center">
                        <h2 class="h2_font">Edit Products</h2>
                        <div class="div_design">
                            <label>Product Title :</label>
                            <input type="text" class="text_color" value="{{old('title', $product->title) }}"
                                name="title" placeholder="Write A Title">
                            <div class="error_style" style="color: red">{{$errors->first('title')}}</div>
                        </div>

                        <div class="div_design">
                            <label>Product description:</label>
                            <input type="text" class="text_color" value="{{old('description', $product->description)}}"
                                name="description" placeholder="Write A description">
                            <div class="error_style" style="color: red">{{$errors->first('description')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product price:</label>
                            <input type="number" class="text_color" value="{{old('price',$product->price)}}"
                                name="price" placeholder="Write A price">
                            <div class="error_style" style="color: red">{{$errors->first('price')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product discount price:</label>
                            <input type="number" class="text_color"
                                value="{{old('discount_price',$product->discount_price)}}" name="discount_price"
                                placeholder="Write A discount price">
                            <div class="error_style" style="color: red">{{$errors->first('discount_price')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product quantity:</label>
                            <input type="number" class="text_color" value="{{old('quantity',$product->quantity)}}"
                                min="0" name="quantity" placeholder="Write A quantity">
                            <div class="error_style" style="color: red">{{$errors->first('quantity')}}</div>
                        </div>
                        <div class="div_design">
                            <label>Product Category:</label>
                            {{-- <select class="text_color" name="catagory">
                                <option value="{{$product->catagory}}" selected="">{{$product->catagory}}</option>

                                @foreach($categories as $catagory)
                                <option value="{{$catagory->category_name}}">{{$catagory->category_name}}</option>
                                <option value="{{$catagory->category_name}}">{{$catagory->category_name}}</option>

                                @endforeach
                            </select> --}}
                            <select class="text_color" name="catagory">
                                @foreach($categories as $category)
                                <option value="{{ $category->category_name }}" {{ $product->catagory ==
                                    $category->category_name ? 'selected' : ''
                                    }}>
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="error_style" style="color: red">{{$errors->first('category')}}</div>
                        </div>
                        {{-- image show to come db --}}
                        {{-- <div class="img_size">
                            <label>Show Product Image:</label>
                            <img class="img_css" src="{{ asset('product/' . $product->image) }}" alt="productImg" />
                            <h3 class="h3_css">Info:-This is your added Image and in case if you want to change this
                                image
                                upload
                                New Image.!</h3>
                        </div> --}}

                        {{-- image show to come db --}}
                        <div class="div_design">

                            <label>Show Now Product Image:</label>
                            <img class="img_css" src="{{ asset('storage/product/' . $product->image) }}"
                                alt="productImg" />

                            <h5 class="h5_css"><i class="mdi mdi-information"></i>This is your added Image and in case
                                if you want to change this
                                Image,
                                upload
                                New Image.!</h5>

                        </div>
                        {{-- end image showing --}}


                        {{-- add new image --}}
                        <div class="div_design">
                            <label>Upload New Product Image:</label>
                            <input type="file" name="image" placeholder="" />
                            {{-- <div class="error_style" style="color: red">{{$errors->first('image')}}</div> --}}
                        </div>
                        {{-- end new image --}}
                        <div class="div_design">
                            <input type="submit" value="Update Products" class="btn btn-primary">

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