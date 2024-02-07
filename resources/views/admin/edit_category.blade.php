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


                <div class="col-sm-12" style="text-align: right">
                    <a href="{{url('view_category')}}" class="btn btn-primary">Back</a>
                </div>

                {{-- category form to save db --}}
                <div class="div_center">
                    <h2 class="h2_font">Edit Category</h2>
                    <form action="{{route('update_category')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$edit_category->id}}" class="form-control" id=""
                            placeholder="">
                        <div class="col-sm-auto d-flex flex-column justify-content-center align-items-center">
                            <div class="d-flex flex-column">
                                <div class="row mx-0">
                                    <input class="input_color"
                                        value="{{old('category', $edit_category->category_name) }}" type="text"
                                        name="category" placeholder="Write Category Name" />
                                    <input type="submit" class="btn btn-primary" name="submit" value="Edit Category" />
                                </div>
                                <div class="error_style" style="color: red">{{$errors->first('category')}}</div>
                            </div>
                        </div>


                    </form>
                </div>
                {{-- category form end to save db --}}
            </div>
        </div>




        @include('admin.script')


</body>

</html>