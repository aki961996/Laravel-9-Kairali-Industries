<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">

            {{-- search our products --}}
            <div>
                <form action="{{route('search_product')}}" method="get">
                    @csrf
                    <input style="width:500px;" type="text" name="search" placeholder="Search for something.">
                    <input type="submit" value="search">
                </form>
            </div>
            {{-- end searching products --}}
        </div>
        <div class="row">
            @foreach ($product as $products)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{route('product_detail',encrypt($products->id))}}" class="option1">
                                Product Detils
                            </a>
                            {{-- <a href="" class="option2">
                                Buy Now
                            </a> --}}
                            <form action="{{route('add_cart',encrypt($products->id))}}" method="Post">
                                @csrf
                                <div class="justify-content-center row">
                                    <div class="col-md-3">
                                        <input class="w-100" type="number" name="quantity" value="1" min="1"
                                            style="width:100px" />

                                    </div>
                                    <div class="col-md-4 pl-0 ">
                                        <input type="submit" value="Add To Cart" class="w-100"
                                            style="padding: 12px 5px" />
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="{{asset('storage/product/' . $products->image)}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$products->title}}
                        </h5>
                        @if($products->discount_price != null)
                        <h6 style="color: red">
                            Discount Price
                            <br>
                            ${{$products->discount_price}}
                        </h6>
                        <h6 style="text-decoration:line-through ; color:blue">
                            price
                            <br>
                            ${{$products->price}}
                        </h6>
                        @else
                        <h6 style="color: blue">
                            price
                            <br>
                            ${{$products->price}}
                        </h6>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- pagination --}}

        <div style="padding: 10px; float:right;">
            {!!
            $product->appends(\Illuminate\Support\Facades\Request::except('page'))->links()
            !!}
        </div>

        {{-- end pagination --}}
    </div>
</section>