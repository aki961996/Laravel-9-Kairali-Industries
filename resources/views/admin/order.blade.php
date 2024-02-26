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
            background-color: rgb(117, 22, 8);
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
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')

        {{-- body --}}

        <div class="main-panel">
            <div class="content-wrapper">

                <h1 class="title_des">All Orders</h1>

                {{-- tabel --}}
                <table class="table_des">
                    <tr>
                        <th class="th_des">Name</th>
                        <th class="th_des">Email</th>
                        <th class="th_des">Address</th>
                        <th class="th_des">Phone</th>
                        <th class="th_des">Product Title</th>
                        <th class="th_des">Quantity</th>
                        <th class="th_des">Price</th>
                        <th class="th_des">Payment Status</th>
                        <th class="th_des">Delivery Status</th>
                        <th class="th_des">Image</th>

                    </tr>
                    @foreach($order as $orders)
                    <tr>
                        <td>{{$orders->name}}</td>
                        <td>{{$orders->email}}</td>

                        <td>{{$orders->address}}</td>
                        <td>{{$orders->phone}}</td>
                        <td>{{$orders->product_title}}</td>
                        <td>{{$orders->quantity}}</td>
                        <td>{{$orders->price}}</td>
                        <td>{{$orders->payment_status}}</td>
                        <td>{{$orders->delivary_status}}</td>
                        <td>
                            <img class="img_size" src="{{ asset('storage/product/' . $orders->image) }}"
                                alt="orderImage" />

                        </td>
                    </tr>

                    @endforeach

                </table>


                {{-- end table --}}








            </div>
        </div>

        {{-- bodyend --}}

        {{-- @yield('content') --}}
        @include('admin.script')
</body>

</html>