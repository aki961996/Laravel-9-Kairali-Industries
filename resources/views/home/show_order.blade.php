<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('home/images/favicon.png')}}" type="">
    <title>Kairali industries-Order</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    {{-- mystyles --}}
    <style type="text/css">
        .center {
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;
        }

        table,
        th,
        td {
            border: 1px solid grey;
        }

        .th_design {
            font-size: 25px;
            padding: 5px;
            background-color: #f7444e;
            color: white;
        }

        .img_des {
            width: 200px;
            height: 200px;
        }

        .td_css {
            border-left: 0;
            border-right: 0;
            color: green;
            font-size: 20px;
        }

        .h1_css {
            font-size: 25px;
            padding-bottom: 15px;
            margin-top: 25px;
        }

        .checkout_css {
            margin-bottom: 10px;
            margin-top: 10px;
        }
    </style>
    {{-- mystyles end here --}}
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        {{-- flash msg strt --}}
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            {{session()->get('message')}}
        </div>
        @endif
        {{-- end flash msg --}}

        {{-- show cart table --}}
        @if(!$order->isEmpty())
        <div class="center">
            <table class="table">
                <tr>
                    <th class="th_design">Product Title</th>
                    <th class="th_design">Product Quantity</th>
                    <th class="th_design">Price</th>
                    <th class="th_design">Total Price</th>
                    <th class="th_design">Payment Status</th>
                    <th class="th_design">Delivary Status</th>
                    <th class="th_design">Image</th>
                    <th class="th_design">Action</th>
                </tr>
                @foreach($order as $orders)
                <tr>
                    <td>{{$orders->product_title}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>${{$orders->price}}</td>
                    <td>${{$orders->price * $orders->quantity}}</td>
                    <td>{{$orders->payment_status}}</td>
                    <td>{{$orders->delivary_status}}</td>
                    <td>
                        <img class="img_des" src="{{asset('storage/product/'. $orders->image)}}" alt="cartImg" />
                    </td>
                    <td>
                        <a href="{{route('remove_order', encrypt($orders->id))}}" class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure to remove this product?')">Remove Order
                            Product
                        </a>
                    </td>
                </tr>

                @endforeach

            </table>

            {{-- i am just plan to put pagination but some logic are do it more --}}

            {{-- pagination --}}
            {{-- <div style="padding: 10px; float:right;">
                {!!
                $cart->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                !!}
            </div> --}}
            {{-- end pagination --}}

        </div>
        @else
        <div class="center">
            <div class="container-fluid  mt-100">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h5>Order</h5>
                            </div>
                            <div class="card-block">
                                <div class="card-logo d-flex justify-content-center mb-3">
                                    {{-- <img src="{{asset('home/images/nocart.png')}}"> --}}
                                </div>
                                <div class="card-area">
                                    <div>Your Order is Empty<br>
                                        Add something to make me happy :)</div>
                                    <a href="{{url('redirect')}}" class="btn btn-primary cart-btn-transform m-3"
                                        data-abc="true">continue
                                        shopping</a>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
        </div>
        @endif
        <!-- footer start -->
        {{-- @include('home.footer') --}}
        <div class="cpy_">
            <p class="mx-auto">©
                <?php echo date("Y"); ?> All Rights Reserved By <a href="#">Kairali industreies</a><br>
                Distributed By <a href="" target="_blank">Aki</a>
            </p>
        </div>
        <!-- footer end -->

        <!-- jQery -->
        <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('home/js/popper.min.js')}}"></script>
        <script src="{{asset('home/js/bootstrap.js')}}"></script>
        <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>