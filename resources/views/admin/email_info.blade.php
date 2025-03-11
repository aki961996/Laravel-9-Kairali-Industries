<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
            font-size: 15px;
            font-weight: bold;
        }

        .text_color {
            color: black;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')

        {{-- @yield('content') --}}
        {{-- body start --}}
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif
                <h1 style="text-align: center; font-size:25px;">Send Email to {{$orders->email}}</h1>
                <form action="{{route('send_user_email',encrypt($orders->id))}}" method="POST">
                    @csrf
                    <div style="padding-left: 35%; padding-top:30px;">
                        <label>Email Greetings</label>
                        <input type="text" class="text_color" name="greeting">
                    </div>

                    <div style="padding-left: 35%; padding-top:30px;">
                        <label>Email FirstLing</label>
                        <input type="text" class="text_color" name="firstling">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px;">
                        <label>Email Body</label>
                        <input type="text" class="text_color" name="body">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px;">
                        <label>Email Button Name</label>
                        <input type="text" class="text_color" name="button">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px;">
                        <label>Email Url</label>
                        <input type="text" class="text_color" name="url">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px;">
                        <label>Email Last Line</label>
                        <input type="text" class="text_color" name="lastline">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px;">

                        <input type="submit" value="Send Email" class="btn btn-primary">
                    </div>

                </form>

            </div>
        </div>

        {{-- body end --}}
        @include('admin.script')
</body>

</html>