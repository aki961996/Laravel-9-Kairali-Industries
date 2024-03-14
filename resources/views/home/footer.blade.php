<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="full">
                    {{-- <div class="logo_footer">
                        <a href="#"><img width="90" src="{{asset('admin/assets/images/7.jpg')}}" alt="#" /></a>
                    </div> --}}
                    <div class="information_f">
                        <p><strong>ADDRESS:</strong> 26:Male, kavalappara, Shoranur</p>
                        <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                        <p><strong>EMAIL:</strong> akhileshakhil96.aa@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget_menu">
                                    <h3>Menu</h3>
                                    <ul>
                                        <li><a href="{{url('/redirect')}}">Home</a></li>
                                        <li><a href="{{url('/redirect')}}">About</a></li>
                                        {{-- <li><a href="{{url('/show_order')}}">Order</a></li> --}}
                                        {{-- <li><a href="#">Testimonial</a></li>
                                        <li><a href="#">Products</a></li> --}}
                                        <li><a href="{{url('/redirect')}}">Products</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="widget_menu">
                                    <h3>Account</h3>
                                    <ul>
                                        <li><a href="{{url('/redirect')}}">Account</a></li>
                                        <li><a href="{{url('show_cart')}}">Cart</a></li>
                                        <li><a href="{{url('/show_order')}}">Order</a></li>
                                        <li><a href="{{url('login')}}">Login</a></li>
                                        <li><a href="{{url('register')}}">Register</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="widget_menu">
                            <h3>Newsletter</h3>
                            <div class="information_f">
                                <p>Subscribe by our newsletter and get update protidin.</p>
                            </div>
                            <div class="form_sub">
                                <form>
                                    <fieldset>
                                        <div class="field">
                                            <input type="email" placeholder="Enter Your Mail" name="email" />
                                            <input type="submit" value="Subscribe" />
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="cpy_">
    <p class="mx-auto">&copy;
        <?php echo date("Y"); ?> All Rights Reserved By <a href="#">Kairali industries</a><br>

        Distributed By <a href="" target="_blank">Tech &hearts;</a>

    </p>
</div>