<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .title_des {
            font-size: 25px;
            text-align: center;
            padding-bottom: 40px;
            font-weight: bold;
        }

        .table_des {
            border: 2px solid white;
            width: 100%;
            margin: auto;

            text-align: center;
        }

        .th_des {
            /* background-color: rgb(117, 22, 8); */
            background-color: #074281;
            padding: 30px;
        }

        .table_des tr th,
        .table_des tr td {
            padding: 5px;
        }

        .img_size {
            width: 155px;
            height: 100px;
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
        {{-- body --}}
        <div class="main-panel">
            <div class="content-wrapper">
                {{-- sessio flasing start --}}
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif
                {{-- flashing end --}}
                <h1 class="title_des">All Users</h1>

                {{-- search start --}}
                <div style="padding-left:400px; padding-bottom:30px">
                    <form action="{{route('search_users')}}" method="GET">
                        @csrf
                        <input type="text" class="text_color" name="search" placeholder="Search For Something">

                        <input type="submit" value="Search" class="btn btn-info sm">
                        {{-- <div class="error_style" style="color: red">{{$errors->first('search')}}</div> --}}
                    </form>

                </div>
                {{-- search end --}}




                {{-- tabel --}}
                <div class="table-responsive">
                    <table class="table_des">
                        <tr>
                            <th class="th_des">Name</th>
                            <th class="th_des">Email</th>
                            <th class="th_des">Address</th>
                            <th class="th_des">Phone</th>
                            <th class="th_des">Edit</th>



                        </tr>
                        @forelse($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->phone}}</td>



                            <td>
                                <a href="" class="btn btn-secondary sm">Edit</a>
                            </td>



                        </tr>
                        @empty
                        <tr>
                            <td colspan="15">
                                No Data Found.
                            </td>
                        </tr>

                        @endforelse
                    </table>
                </div>

                {{-- end table --}}
                {{-- pagination --}}
                <div style="padding: 10px; float:right;">
                    {!!
                    $users->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                    !!}
                </div>
            </div>
        </div>
        {{-- bodyend --}}
        {{-- @yield('content') --}}
        @include('admin.script')
</body>

</html>