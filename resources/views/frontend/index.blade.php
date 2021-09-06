@extends('frontend.layouts.master')
@section('title','E-SHOP || HOME PAGE')
@section('main-content')
    <!-- Slider Area -->
    <section class="hero-slider">
        <!-- Single Slider -->
        <div class="single-slider">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-9 offset-lg-3 col-12">
                        <div class="text-inner">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <div class="hero-text">
                                        <h1><span>UP TO 50% OFF </span>Shirt For Man</h1>
                                        <p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find
                                            it pereri <br> odiy maboriosm.</p>
                                        <div class="button">
                                            <a href="#" class="btn">Shop Now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Single Slider -->
    </section>
    @if(count($banners)>0)
        <section id="Gslider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($banners as $key=>$banner)
                    <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
                @endforeach

            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach($banners as $key=>$banner)
                    <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                        <img class="first-slide" src="{{$banner->photo}}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block text-left">
                            <h1 class="wow fadeInDown">{{$banner->title}}</h1>
                            <p>{!! html_entity_decode($banner->description) !!}</p>
                            <a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{route('product-grids')}}"
                               role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </section>
    @endif
    <!--/ End Slider Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="midium-banner">
        <div class="container">
            <div class="row">
            @if($featured_products)
                @foreach($featured_products as $featured_product)
                    <!-- Single Banner  -->
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="single-banner">

                                <img src="{{ $featured_product->imageUrl }}" alt="{{$featured_product->imageUrl}}">
                                <div class="content">
                                    <p> @foreach($featured_product->categories as $category)
                                            {{$category->title}}
                                        @endforeach</p>
                                    <h3>{{$featured_product->title}} <br>Up
                                        to<span> {{$featured_product->discount}}%</span></h3>
                                    <a href="{{route('product-detail',$featured_product->slug)}}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- /End Single Banner  -->
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- End Midium Banner -->

    <!-- Start Most Popular -->
    <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Hot Item</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)
                        <!-- Start Single Product -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{route('product-detail',$product->slug)}}">
                                        <img class="default-img" src="{{ $product->imageUrl }}"
                                             alt="{{$product->imageUrl}}">
                                        <img class="hover-img" src="{{$product->imageUrl}}"
                                             alt="{{$product->imageUrl}}">
                                        {{-- <span class="out-of-stock">Hot</span> --}}
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#{{$product->id}}"
                                               title="Quick View" href="#"><i
                                                        class=" ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist"
                                               href="{{route('add-to-wishlist',$product->slug)}}"><i
                                                        class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                    </h3>
                                    <div class="product-price">
                                        <span class="old">${{number_format($product->price,2)}}</span>
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100)
                                        @endphp
                                        <span>${{number_format($after_discount,2)}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Most Popular Area -->

    <!-- Start Shop Home List  -->
    <section class="shop-home-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-section-title">
                                <h1>Latest Items</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @foreach($product_lists as $product)
                            <div class="col-md-4">
                                <!-- Start Single List  -->
                                <div class="single-list">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="list-image overlay">
                                                <img src="{{$product->imageUrl}}" alt="{{$product->imageUrl}}">
                                                <a href="{{route('add-to-cart',$product->slug)}}" class="buy"><i
                                                            class="fa fa-shopping-bag"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                                            <div class="content">
                                                <h4 class="title"><a href="#">{{$product->title}}</a></h4>
                                                <p class="price with-discount">
                                                    ${{number_format($product->discount,2)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single List  -->
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Home List  -->
    @foreach($featured_products as $featured_product)
        <!-- Start Cowndown Area -->
        <section class="cown-down">
            <div class="section-inner ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-12 padding-right">
                            <div class="image">
                                @php
                                    $photo=explode(',',$featured_product->photo);
                                    // dd($photo);
                                @endphp
                                <img src="{{$photo[0]}}" alt="{{$photo[0]}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 padding-left">
                            <div class="content">
                                <div class="heading-block">
                                    <p class="small-title">Deal of day</p>
                                    <h3 class="title">{{$featured_product->title}}</h3>
                                    <p class="text">{!! html_entity_decode($featured_product->summary) !!}</p>
                                    @php
                                        $after_discount=100
                                    @endphp
                                    <h1 class="price">${{number_format($after_discount)}}
                                        <s>${{number_format($featured_product->price)}}</s></h1>
                                    <div class="coming-time">
                                        <div class="clearfix" featured_product-countdown="2021/02/30"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /End Cowndown Area -->
    @endforeach
    <!-- Start Shop Blog  -->
    <section class="shop-blog section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>From Our Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($posts)
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start Single Blog  -->
                            <div class="shop-single-blog">
                                <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                <div class="content">
                                    <p class="date">{{$post->created_at->format('d M , Y. D')}}</p>
                                    <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                    <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Continue Reading</a>
                                </div>
                            </div>
                            <!-- End Single Blog  -->
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- End Shop Blog  -->

    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    @include('frontend.layouts.newsletter')

    <!-- Modal -->
    @if($product_lists)
        @foreach($product_lists as $key=>$product)
            <div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        class="ti-close" aria-hidden="true"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row no-gutters">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <!-- Product Slider -->
                                    <div class="product-gallery">
                                        <div class="quickview-slider-active">
                                            <div class="single-slider">
                                                <img src="{{$product->imageUrl}}" alt="{{$product->imageUrl}}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Product slider -->
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="quickview-content">
                                        <h2>{{$product->title}}</h2>
                                        <div class="quickview-ratting-review">
                                            <div class="quickview-ratting-wrap">
                                                <div class="quickview-ratting">
                                                    {{-- <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="fa fa-star"></i> --}}
                                                    @php
                                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <i class="yellow fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <a href="#"> ({{$rate_count}} customer review)</a>
                                            </div>
                                            <div class="quickview-stock">
                                                @if($product->stock >0)
                                                    <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                                @else
                                                    <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                        <h3><small>
                                                <del class="text-muted">${{number_format($product->price,2)}}</del>
                                            </small> ${{number_format($after_discount,2)}}  </h3>
                                        <div class="quickview-peragraph">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        @if($product->size)
                                            <div class="size">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <h5 class="title">Size</h5>
                                                        <select>
                                                            @php
                                                                $sizes=explode(',',$product->size);
                                                                // dd($sizes);
                                                            @endphp
                                                            @foreach($sizes as $size)
                                                                <option>{{$size}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="col-lg-6 col-12">
                                                        <h5 class="title">Color</h5>
                                                        <select>
                                                            <option selected="selected">orange</option>
                                                            <option>purple</option>
                                                            <option>black</option>
                                                            <option>pink</option>
                                                        </select>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endif
                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="quantity">
                                                <!-- Input Order -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                                disabled="disabled" data-type="minus"
                                                                data-field="quant[1]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                                    <input type="text" name="quant[1]" class="input-number" data-min="1"
                                                           data-max="1000" value="1">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number"
                                                                data-type="plus" data-field="quant[1]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ End Input Order -->
                                            </div>
                                            <div class="add-to-cart">
                                                <button type="submit" class="btn">Add to cart</button>
                                                <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i
                                                            class="ti-heart"></i></a>
                                            </div>
                                        </form>
                                        <div class="default-social">
                                            <!-- ShareThis BEGIN -->
                                            <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!-- Modal end -->
@endsection

@push('styles')
    <script type='text/javascript'
            src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons'
            async='async'></script>
    <script type='text/javascript'
            src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons'
            async='async'></script>
    <style>
        /* Banner Sliding */
        #Gslider .carousel-inner {
            background: #000000;
            color: black;
        }

        #Gslider .carousel-inner {
            height: 550px;
        }

        #Gslider .carousel-inner img {
            width: 100% !important;
            opacity: .8;
        }

        #Gslider .carousel-inner .carousel-caption {
            bottom: 60%;
        }

        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 50px;
            font-weight: bold;
            line-height: 100%;
            color: #F7941D;
        }

        #Gslider .carousel-inner .carousel-caption p {
            font-size: 18px;
            color: black;
            margin: 28px 0 28px 0;
        }

        #Gslider .carousel-indicators {
            bottom: 70px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							// document.location.href=document.location.href;
						});
					}
                    else{
                        window.location.href='user/login'
                    }
                }
            })
        });
    </script> --}}
    {{-- <script>
        $('.wishlist').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            // alert(pro_id);
            $.ajax({
                url:"{{route('add-to-wishlist')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id,
                },
                success:function(response){
                    if(typeof(response)!='object'){
                        response=$.parseJSON(response);
                    }
                    if(response.status){
                        swal('success',response.msg,'success').then(function(){
                            document.location.href=document.location.href;
                        });
                    }
                    else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						});
                    }
                }
            });
        });
    </script> --}}
    <script>

        /*==================================================================
        [ Isotope ]*/
        const $topeContainer = $('.isotope-grid');
        const $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                const filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            const $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'fitRows',
                    percentPosition: true,
                    animationEngine: 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        const isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function () {
            $(this).on('click', function () {
                for (let i = 0; i < isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');
            });
        });
    </script>
    <script>
        function cancelFullScreen(el) {
            const requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                const wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            const requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                const wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }
    </script>

@endpush
