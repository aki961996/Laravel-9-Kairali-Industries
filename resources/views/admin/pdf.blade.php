<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf</title>
</head>

<body>

    <h1>Order Details</h1>

    Customer Name :<h5>{{$order_data->name}}</h5>
    Customer Email:<h3>{{$order_data->email}}</h3>
    Customer Phone:<h3>{{$order_data->phone}}</h3>
    Customer Address:<h3>{{$order_data->address}}</h3>
    Customer ID : <h3>{{$order_data->user_id}}</h3>
    Product Name:<h3>{{$order_data->product_title}}</h3>
    Product Price:<h3>{{$order_data->price}}</h3>
    Product Quantity:<h3>{{$order_data->quantity}}</h3>
    Product Status:<h3>{{$order_data->payment_status}}</h3>
    Product ID:<h3>{{$order_data->product_id}}</h3>


    <img style="width: 150px; height: 150px;" src="{{ public_path('storage/product/' . $order_data->image) }}" alt="" />



</body>

</html>