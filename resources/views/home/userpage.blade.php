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
    <link rel="shortcut icon" href="home/images/favicon.png" type="">
    <title>Kairali industries</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->
        @include('home.slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    @include('home.endwhysection')
    <!-- end why section -->

    <!-- arrival section -->
    {{-- @include('home.arrival') --}}
    <!-- end arrival section -->

    <!-- product section -->
    @include('home.product')
    <!-- end product section -->


    {{-- comment and replay starts here --}}


    <div style="text-align: center; padding-bottom:30px;">
        <h1 style="font-size: 30px; text-align:center; padding-top:20px; padding-bottom:20px;">Comments</h1>
        <form>
            <textarea style="height: 150px; width:600px;" placeholder="Comment Something Here!!"></textarea>
            <br>
            <a href="" class="btn btn-dark">Comment</a>
        </form>
    </div>

    <div style="padding-left: 20%;">
        <h1 style="font-size: 20px; padding-bottom:20px">All Comments</h1>
        <div>
            <b>Aki</b>
            <p>This is my first comment</p>

            <a href="javascript:void(0);" onclick="reply(this);">Reply</a>
        </div>

        <div>
            <b>Jhon </b>
            <p>second comment</p>

            <a href="javascript:void(0);" onclick="reply(this);">Reply</a>
        </div>
        <div>
            <b>Dalton</b>
            <p>This is my 3 </p>

            <a href="javascript:void(0);" onclick="reply(this);">Reply</a>
        </div>

        <div>
            <b>newjry</b>
            <p>This new comment</p>

            <a href="javascript:void(0);" onclick="reply(this);">Reply</a>
        </div>

        <div style="display: none;" class="rplyDiv">
            <textarea style="height: 100px; width:500px;" placeholder="Write Something Here"></textarea>
            <br>
            <a href="" class="btn btn-dark">Reply</a>
        </div>
    </div>



    {{-- comment and replay end here --}}


    <!-- subscribe section -->
    {{-- @include('home.subscribe') --}}
    <!-- end subscribe section -->
    <!-- client section -->
    {{-- @include('home.client') --}}
    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    <script type="text/javascript">
        function reply(caller){
            $('.rplyDiv').insertAfter($(caller));
            $('.rplyDiv').show();

    }
    </script>

    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>