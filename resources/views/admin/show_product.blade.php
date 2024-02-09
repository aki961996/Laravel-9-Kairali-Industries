<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .center {
            margin: auto;
            width: 50%;
            border: 2px solid white;
            margin-top: 50px;
            text-align: center;
        }

        .font_size {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }

        .img_size {
            width: 100px;
            height: 100px;
            margin: 5px;
        }

        .th_color {
            background-color: skyblue;
        }

        .th_des {
            padding: 30px;
        }

        .scrolled_up {
            max-width: 100%;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="font_size">All Products</h2>
                <div class="scrolled_up">
                    <table class="center">
                        <tr class="th_color">
                            {{-- table heading --}}
                            <th class="th_des">Product Title</th>
                            <th class="th_des">Description</th>
                            <th class="th_des">Catagory</th>
                            <th class="th_des">Quantity</th>
                            <th class="th_des">Prize</th>
                            <th class="th_des">Discount Price</th>
                            <th class="th_des">Image</th>
                            <th class="th_des">Delete</th>
                            <th class="th_des">Edit</th>
                        </tr>
                        @foreach ($products as $product)
                        <tr>
                            {{-- table data --}}
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->catagory}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount_price}}</td>
                            <td>
                                <img class="img_size" src="{{asset('product/' . $product->image)}}">
                            </td>
                            <td>
                                <a class="btn btn-danger" href="">Delete</a>
                            </td>
                            <td>

                                <a class="btn btn-info" href="{{route('edit_product',encrypt($product->id))}}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                {{-- pagination --}}
                <div style="padding: 10px; float:right;">
                    {!!
                    $products->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                    !!}
                </div>

            </div>
        </div>
        @include('admin.script')
</body>

</html>