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
        }

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
                        <input class="input_color" type="text" name="category" placeholder="Write Category Name" />
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category" />
                    </form>
                </div>

                {{-- need to show the category data from db --}}
                <table class="center">
                    <tr>
                        <td>Catagory name</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($category_data as $category)
                    <tr>
                        <td>{{$category->category_name}}</td>
                        <td>
                            <a class="btn btn-danger " href="">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>



            </div>
        </div>




        @include('admin.script')


</body>

</html>