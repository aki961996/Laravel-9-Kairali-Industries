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
    <title>Kairali industries</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
    <style type="text/css">
        .comments-container {
            max-width: 1200px;
            margin: 25px auto;
        }

        .comments-container .user-comments-block {
            background: #fff;
            border: solid 1px #fff;
            border: solid 1px #ddd;
            height: 35px;
            border-radius: 5px;
        }

        .comments-container .user-comments-block textarea {
            width: 100%;
            height: 100%;
            resize: none;
            font-size: 13px;
            color: #383838;
            border: 0px;
            padding: 5px 8px;
            border-radius: 5px;
        }

        .comments-container .button-csubmit {
            border: 0;
            background: red;
            color: #fff;
            border-radius: 5px;
            padding: 4px 8px;
            min-width: 70px;
            margin: 10px 0;
        }

        .comments-container .comments-results {
            margin: 15px 0;
            max-height: 350px;
            overflow-y: auto;
            padding: 0px 5px;
        }

        .comments-results .result-box {
            border: solid 1px #ddd;
            border-radius: 5px;
            padding: 8px;
            color: #344141;
            font-size: 13px;
            margin: 8px 0;
        }

        .comments-results .action-area {
            border-top: solid 1px #ddd;
            padding: 5px 0;
            margin-top: 8px;
            text-align: right;
        }

        .comments-results .button-replay {
            border: 0;
            background: rgb(55, 163, 78);
            color: #fff;
            border-radius: 5px;
            padding: 4px 8px;
            min-width: 70px;
        }

        .replay-area {
            color: #918888;
            font-size: 12px;
            text-align: right;
        }

        form input {
            text-transform: none;
        }
    </style>

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

    <!-- subscribe section -->
    {{-- @include('home.subscribe') --}}
    <!-- end subscribe section -->
    <!-- client section -->
    {{-- @include('home.client') --}}
    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    {{-- Refresh Page and Keep Scroll Position --}}
    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
                var scrollpos = localStorage.getItem('scrollpos');
                if (scrollpos) window.scrollTo(0, scrollpos);
            });
    
            window.onbeforeunload = function(e) {
                localStorage.setItem('scrollpos', window.scrollY);
            };
    </script>
    {{-- end Refresh Page and Keep Scroll Position --}}

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