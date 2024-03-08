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


    {{-- comment and replay starts here --}}
    <div class="comments-container">
        <div class="user-comments">
            <form action="{{route('comment_add')}}" method="POST"> @csrf <textarea name="comment"
                    placeholder="Comment Something Here!!"></textarea>
                <input type="submit" class="button-csubmit" value="Comment">
            </form>
        </div>
        <div class="comments-results">
            <h1>All Comments</h1>
            @foreach($comment as $comments)
            <div>
                <b>{{$comments->name}}</b>
                <p>{{$comments->comment}}</p> 
                <a href="javascript:void(0);" onclick="reply(this);"
                    data-commentid="{{$comments->id}}">Reply</a> 
                    @foreach($reply as $rply)
                     @if($rply->comment_id == $comments->id) 
                <div style="padding-left: 3%; padding-bottom:10px; padding-bottom:10px">
                    <p>{{$rply->name}}</p>
                    <p>{{$rply->reply}}</p> 
                    <a href="javascript:void(0);" onclick="reply(this);"
                        data-commentid="{{$comments->id}}">Reply</a>
                </div>
                @endif
                @endforeach
            </div>
            @endforeach
            {{-- reply text boxes --}}
            <div style="display: none;" class="rplyDiv">
                <form action="{{route('add_reply')}}" method="POST"> @csrf {{-- this is hidden feild for commentId --}}
                    <input type="text" id="commentId" name="commentId" hidden=""> <textarea
                        style="height: 100px; width:500px;" placeholder="Write Something Here" name="reply"></textarea>
                    <br>
                    <button type="submit" class="btn btn-success">Reply</button> <a href="javascript:void(0);"
                        class="btn" onclick="reply_close(this)">Close</a>
                </form>
            </div> {{-- reply text boxes --}}
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
           
            //value evide kiti commentId hiiden feilds lot vach
             // document.getElementById('commentId').value=$(caller).attr('data-commentid')
              $id= document.getElementById('commentId').value=$(caller).attr('data-commentid');

                 $('.rplyDiv').insertAfter($(caller));
                 $('.rplyDiv').show();
        }

        function reply_close(caller){
            $('.rplyDiv').hide();
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