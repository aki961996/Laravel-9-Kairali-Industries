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
    <title>Kairali industries-Cart</title>
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
        {{-- sweet alert --}}
        @include('sweetalert::alert')
        {{-- sweet alert --}}
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            {{session()->get('message')}}
        </div>
        @endif
        {{-- end flash msg --}}


        {{-- show cart table --}}
        @if(!$cart->isEmpty())
        <div class="center">
            <table class="table">
                <tr>
                    <th class="th_design">Product Title</th>
                    <th class="th_design">Product Quantity</th>
                    <th class="th_design">Price</th>
                    <th class="th_design">Total Price</th>
                    <th class="th_design">Image</th>
                    <th class="th_design">Action</th>
                </tr>

                <?php $totalPrice=0 ;?>

                @foreach($cart as $cartn)
                <tr>
                    <td>{{$cartn->product_title}}</td>
                    <td>{{$cartn->quantity}}</td>
                    <td>&#8377;{{$cartn->price}}</td>
                    <td>&#8377;{{$cartn->price * $cartn->quantity}}</td>
                    <td>
                        <img class="img_des" src="{{asset('storage/product/'. $cartn->image)}}" alt="cartImg" />
                    </td>
                    <td>
                        <a href="{{route('remove_cart',encrypt($cartn->id))}}" class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure to remove this product?')">Remove
                            Product
                        </a>
                    </td>
                </tr>
                <?php 
                $unitTitalPrice = $cartn->price * $cartn->quantity;
                $totalPrice = $totalPrice + $unitTitalPrice ;?>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: right; border-right: 0; padding-top: 15px;">
                        Total Price:
                    </td>
                    <td class="td_css">
                        ${{$totalPrice}}
                    </td>
                    <td colspan="2" style="border-left: 0"></td>
                </tr>
            </table>

            {{-- i am just plan to put pagination but some logic are do it more --}}

            {{-- pagination --}}
            {{-- <div style="padding: 10px; float:right;">
                {!!
                $cart->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                !!}
            </div> --}}
            {{-- end pagination --}}
            <div>

                <h1 class="h1_css">Proceed to Order:</h1>
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{route('cash_order')}}" class="btn btn-outline-dark mr-2">Cash On Delivary</a>
                    {{-- <form action="{{route('stripePost',$totalPrice )}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="btn btn-outline-success" type="submit" id="">Pay Using Card</button>
                    </form> --}}
                    {{-- <a href="{{route('charge_stripe',$totalPrice )}}" class="btn btn-outline-success">Pay Using
                        Card</a>
                    --}}
                    <form class="checkout_css" action="{{route('session')}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-outline-success"
                            id="checkout-live-button">Checkout</button>
                    </form>
                </div>


            </div>
        </div>
        @else

        <div class="center">
            <div class="container-fluid  mt-100">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h5>Cart</h5>
                            </div>
                            <div class="card-block">
                                <div class="card-logo d-flex justify-content-center mb-3">
                                    <img src="{{asset('home/images/nocart.png')}}">
                                </div>
                                <div class="card-area">
                                    <div>Your Cart is Empty<br>
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








        {{--
    </div> --}}
    {{-- end show cart table --}}

    <!-- footer start -->
    {{-- @include('home.footer') --}}
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="" target="_blank">Aki</a>

        </p>
    </div>
    <!-- footer end -->
    <!-- jQery -->
    <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>