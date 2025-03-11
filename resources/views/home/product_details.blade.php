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
    <title>Kairali industries-Product details</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />


</head>


<body>
    <div class="hero_area">

        {{-- sweet alert --}}
        @include('sweetalert::alert')
        {{-- sweet alert --}}



        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        {{-- product details body --}}
        {{-- **************************************** --}}
        {{-- **************************************** --}}
        {{-- **************************************** --}}
        <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width:50%;">

            <div class="img-box" style="">
                <img src="{{asset('storage/product/' . $product->image)}}" alt="">
            </div>
            <div class="detail-box">
                <h5>
                    {{$product->title}}
                </h5>
                @if($product->discount_price != null)
                <h6 style="color: red">
                    Discount Price
                    <br>
                    ${{$product->discount_price}}
                </h6>
                <h6 style="text-decoration:line-through ; color:blue">
                    price
                    <br>
                    ${{$product->price}}
                </h6>
                @else
                <h6 style="color: blue">
                    price
                    <br>
                    ${{$product->price}}
                </h6>
                @endif

                <h6>
                    Product Catagory: {{$product->catagory}}
                </h6>
                <h6>
                    Product Details : {{$product->description}}
                </h6>
                <h6>
                    Available Quantity :{{$product->quantity}}
                </h6>


                <form action="{{route('add_cart',encrypt($product->id))}}" method="Post">
                    @csrf
                    <div class="justify-content-center row">
                        <div class="col-md-3">
                            <input class="w-100" type="number" name="quantity" value="1" min="1" style="width:100px" />

                        </div>
                        <div class="col-md-4 pl-0">
                            <input type="submit" value="Add To Cart" class="w-100" style="padding: 12px 5px" />
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- end product details --}}
    {{-- **************************************** --}}
    {{-- **************************************** --}}
    {{-- **************************************** --}}
    <!-- footer start -->
    {{-- @include('home.footer') --}}
    <div class="cpy_">
        <p class="mx-auto">&copy;
            <?php echo date("Y"); ?> All Rights Reserved By <a href="#">Kairali industries</a><br>
            Distributed By <a href="#" target="_blank">Aki</a>
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