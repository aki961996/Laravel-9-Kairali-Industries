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

    <style type="text/css">
        .center {
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        <div class="hero_area">
            <div class="center">
                <form action="{{route('session',$totalPrize)}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-success" id="checkout-live-button">Checkout</button>
                </form>


            </div>
        </div>

        <!-- footer start -->
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