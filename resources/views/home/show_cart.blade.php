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
    <title>AP - Good Vibes</title>
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
        <div class="center">
            <table class="table">
                <tr>
                    <th class="th_design">Product Title</th>
                    <th class="th_design">Product Quantity</th>
                    <th class="th_design">Price</th>
                    <th class="th_design">Image</th>
                    <th class="th_design">Action</th>
                </tr>

                <?php $totalPrice=0 ;?>

                @foreach($cart as $cartn)
                <tr>

                    <td>{{$cartn->product_title}}</td>
                    <td>{{$cartn->quantity}}</td>
                    <td>${{$cartn->price}}</td>
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
                <?php $totalPrice = $totalPrice + $cartn->price ;?>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align: right; border-right: 0; padding-top: 15px;">
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
                <a href="{{route('cash_order')}}" class="btn btn-outline-dark">Cash On Delivary</a>
                <a href="{{route('stripe',$totalPrice )}}" class="btn btn-outline-success">Pay Using Card</a>
            </div>
        </div>








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