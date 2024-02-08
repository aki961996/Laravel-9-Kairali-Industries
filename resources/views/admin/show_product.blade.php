<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .h2_font {
            font-size: 34px;
            padding-bottom: 40px;
        }

        .div_center {
            text-align: center;
            padding-top: 20px;

        }

        /* .product_description,
        .product_title {
            width: 250px;
            white-space: wrap !important;
        } */
        .product-table tr td {
            white-space: wrap !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')


        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="h2_font">Show Product List</h2>
                <div class="div_center">
                    <table class="table table-striped product-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Catagory</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Discount Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$product->id}}</th>
                                <td class="product_title">{{$product->title}}</td>
                                <td class="product_description">{{$product->description}}</td>
                                <td>{{$product->catagory}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->discount_price}}</td>

                                <td><img src="{{ asset('product/' . $product->image) }}" alt="Product Image"></td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="{{route('edit_product', encrypt($product->id))}}">Edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        @include('admin.script')


</body>

</html>