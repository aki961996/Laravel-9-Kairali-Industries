<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .center {
           
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')

        <div class="main-panel">
            <div class="content-wrapper">
                <table class="center">
                    <tr>
                        {{-- table heading --}}
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Catagory</th>
                        <th>Quantity</th>
                        <th>Prize</th>
                        <th>Discount Price</th>
                        <th>Image</th>
                    </tr>

                    <tr>
                        {{-- table data --}}
                        <td>toy</td>
                        <td>sdg</td>
                        <td>45</td>
                        <td>45</td>
                        <td>5</td>
                        <td>tyu</td>
                        <td>yiy</td>

                    </tr>
                </table>
            </div>
        </div>

        @include('admin.script')


</body>

</html>