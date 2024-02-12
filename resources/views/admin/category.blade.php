<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;

        }

        .h2_font {
            font-size: 34px;
            padding-bottom: 40px;
        }

        .input_color {
            color: black;

            /* width: 200px;

            padding: 10px !important;

            border: 1px solid #ccc;

            border-radius: 10px;

            outline: none;

            transition: border-color 0.3s; */


        }

        /* .input_color:focus {
            border-color: #007bff;
        } */

        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;


        }

        .center td {
            padding-bottom: 5px;
        }

        .error_style {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')
        {{-- category body --}}
        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                    {{session()->get('message')}}
                </div>
                @endif

                {{-- category form to save db --}}
                <div class="div_center">
                    <h2 class="h2_font">Add Category</h2>
                    <form action="{{route('add_category')}}" method="post">
                        @csrf
                        <div class="col-sm-auto d-flex flex-column justify-content-center align-items-center">
                            <div class="d-flex flex-column">
                                <div class="row mx-0">
                                    <input class="input_color" type="text" name="category"
                                        placeholder="Write Category Name" />
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category" />
                                </div>
                                <div class="error_style" style="color: red">{{$errors->first('category')}}</div>
                            </div>
                        </div>


                    </form>
                </div>
                {{-- category form end to save db --}}

                {{-- need to show the category data from db --}}
                <table class="center">
                    <tr>
                        <td>Catagory name</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($category_data as $category)
                    <tr>
                        <td>{{$category->category_name}}</td>
                        {{-- <td>
                            <a class="btn btn-primary" href="{{route('edit_category',encrypt($category->id))}}">Edit</a>
                        </td> --}}
                        <td>
                            <a class="btn btn-primary"
                                href="{{ route('edit_category', encrypt($category->id)) }}">Edit</a>
                        </td>

                        <td>
                            <a class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this item?')"
                                href="{{route('delete_category',encrypt($category->id))}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{-- end need to show the category data from db --}}
                {{-- pagination --}}
                <div style="padding: 10px; float:right;">
                    {!!
                    $category_data->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
                    !!}
                </div>
            </div>
        </div>

        @include('admin.script')

</body>

</html>