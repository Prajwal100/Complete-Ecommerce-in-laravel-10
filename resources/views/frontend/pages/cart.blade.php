@extends('frontend.layouts.master')
@section('title','Cart Page')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Cart</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
			
	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
							@if(session('cart'))
								@foreach(session('cart') as $key=>$cart)
									{{-- <tr>
										@php 
										$photo=explode(',',$cart['photo']);
										@endphp
										<td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="{{$cart['link']}}">{{$cart['title']}}</a></p>
											<p class="product-des">{!!($cart['summary']) !!}</p>
										</td>
										<td class="price" data-title="Price"><span>${{number_format($cart['price'],2)}}</span></td>
										<td class="qty" data-title="Qty"><!-- Input Order -->
											<div class="input-group">
												<div class="button minus">
													<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
														<i class="ti-minus"></i>
													</button>
												</div>
											<input type="text" name="quant[]" class="input-number"  data-min="1" data-max="100" value="{{$cart['quantity']}}">
												<div class="button plus">
													<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
														<i class="ti-plus"></i>
													</button>
												</div>
											</div>
											<!--/ End Input Order -->
										</td>
										<td class="total-amount cart_single_price" data-title="Total"><span class="money">${{$cart['amount']}}</span></td>
										<td>
											<div class="product_count">
											  <input type="text" name="qty[]" maxlength="12" value="{{$cart['quantity']}}" class="input-text qty"/>
											  <input type="hidden" name="qty_id[]" value="{{$cart['id']}}">
											  
											  <button class="cart_u increase items-count" type="button"><i class="fas fa-angle-up"></i></button>
											  <button class="cart_u reduced items-count" type="button"><i class="fas fa-angle-down"></i></button>
											</div>
										  </td>
										  <td>
											<h5 class="cart_single_total"><span class="money">${{$cart['amount']}}</span></h5>
										  </td>
										<td class="action" data-title="Remove"><a href="{{route('remove-from-cart',$key)}}"><i class="ti-trash remove-icon"></i></a></td>
									</tr> --}}
									<tr class="single_cart_item">

										{{-- <td>
										  <h5 class="cart_single_price"><span class="money">{{Helper::currency_amount($cart->product->offer_price)}}</span>{{Helper::currency()}}</h5>
										</td> --}}
										<td>
										  <div class="product_count">
											<input type="text" name="qty[]" maxlength="12" value="{{$cart['quantity']}}" class="input-text qty"/>
											<input type="hidden" name="qty_id[]" value="{{$cart['id']}}">
											
											<button class="cart_u increase items-count" type="button"><i class="fas fa-angle-up"></i></button>
											<button class="cart_u reduced items-count" type="button"><i class="fas fa-angle-down"></i></button>
										  </div>
										</td>
										<td>
										  <h5 class="cart_single_total"><span class="money">{{$cart['amount']}}</span></h5>
										</td>
										{{-- <td>
										  <a href="{{route('cart.delete', $cart->id)}}" class="btn btn-danger">Delete</a>
										</td> --}}
									  </tr>
								@endforeach
							@else 
									<tr>
										<td class="text-center">
											There are no any carts available. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>

										</td>
									</tr>
							@endif


						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left">
									<div class="coupon">
									<form action="{{route('coupon-store')}}" method="POST">
											@csrf
											<input name="code" placeholder="Enter Your Coupon">
											<button class="btn">Apply</button>
										</form>
									</div>
									<div class="checkbox">`
										@php 
											$shipping=DB::table('shippings')->where('status','active')->limit(1)->get();
										@endphp
										<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+@foreach($shipping as $cost) {{$cost->price}} @endforeach$)</label>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									@php 
										$total_prod=0;
										$total_amount=0;
									@endphp
									@if(session('cart'))
											@foreach(session('cart') as $cart_items)
												@php
													$total_prod+=$cart_items['quantity'];
													$total_amount+=$cart_items['amount'];
												@endphp
											@endforeach
									@endif
									<ul>
										<li>Cart Subtotal<span>${{number_format($total_amount,2)}}</span></li>
										<li>Shipping<span>Free</span></li>
										@if(session('coupon'))
										<li>You Save<span>${{number_format(session('coupon')['value'],2)}}</span></li>
										@endif
										@if(session('coupon'))
										@php
											$total_amount=$total_amount-session('coupon')['value'];
										@endphp
										<li class="last">You Pay<span>${{number_format($total_amount,2)}}</span></li>
										@endif
										<li class="last">You Pay<span>${{number_format($total_amount,2)}}</span></li>
									</ul>
									<div class="button5">
										<a href="{{route('checkout')}}" class="btn">Checkout</a>
										<a href="{{route('product-grids')}}" class="btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
			
	<!-- Start Shop Services Area  -->
	<section class="shop-services section">
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
	<!-- End Shop Newsletter -->
	
	<!-- Start Shop Newsletter  -->
	@include('frontend.layouts.newsletter')
	<!-- End Shop Newsletter -->
	
	
	
	<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <!-- Product Slider -->
									<div class="product-gallery">
										<div class="quickview-slider-active">
											<div class="single-slider">
												<img src="images/modal1.jpg" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal2.jpg" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal3.jpg" alt="#">
											</div>
											<div class="single-slider">
												<img src="images/modal4.jpg" alt="#">
											</div>
										</div>
									</div>
								<!-- End Product slider -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="quickview-content">
                                    <h2>Flared Shift Dress</h2>
                                    <div class="quickview-ratting-review">
                                        <div class="quickview-ratting-wrap">
                                            <div class="quickview-ratting">
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="yellow fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <a href="#"> (1 customer review)</a>
                                        </div>
                                        <div class="quickview-stock">
                                            <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                        </div>
                                    </div>
                                    <h3>$29.00</h3>
                                    <div class="quickview-peragraph">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
                                    </div>
									<div class="size">
										<div class="row">
											<div class="col-lg-6 col-12">
												<h5 class="title">Size</h5>
												<select>
													<option selected="selected">s</option>
													<option>m</option>
													<option>l</option>
													<option>xl</option>
												</select>
											</div>
											<div class="col-lg-6 col-12">
												<h5 class="title">Color</h5>
												<select>
													<option selected="selected">orange</option>
													<option>purple</option>
													<option>black</option>
													<option>pink</option>
												</select>
											</div>
										</div>
									</div>
                                    <div class="quantity">
										<!-- Input Order -->
										<div class="input-group">
											<div class="button minus">
												<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
													<i class="ti-minus"></i>
												</button>
											</div>
											<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
											<div class="button plus">
												<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
													<i class="ti-plus"></i>
												</button>
											</div>
										</div>
										<!--/ End Input Order -->
									</div>
									<div class="add-to-cart">
										<a href="#" class="btn">Add to cart</a>
										<a href="#" class="btn min"><i class="ti-heart"></i></a>
										<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
									</div>
                                    <div class="default-social">
										<h4 class="share-now">Share:</h4>
                                        <ul>
                                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                            <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
	
@endsection
@push('scripts')
<script>
	 $(document).ready(function(){

	$('.cart_u.increase').click(function(){
		cart_count_update(this, 'add');
	});

	$('.cart_u.reduced').click(function(){
		cart_count_update(this, '');
	});

	$('.product_count>.qty').keyup(function(){
		cart_update_keyup(this);
	});

	//payment option
	$('input[name=paymentoption]').click(function(){
		$(this).parents('.payment_item').removeClass('bKash cash rocket').addClass($(this).val() +' active');
	});
	$('.shipping select[name=shipping]').change(function(){
		let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
		let subtotal = parseFloat( $('.order_sutotal').data('price') ); 
		let currency = $('.order_sutotal').data('currency'); 
		$('#order_total_price span').text( (subtotal + cost).toFixed(2) + currency );
	});

	});

	function cart_count_update(el, opt){
	let single_cart_item = $(el).parent().parent().parent('.single_cart_item');

	let cart_single_price = $(single_cart_item).find('.cart_single_price>.money');
	let cart_single_total = $(single_cart_item).find('.cart_single_total>.money');

	let single_price = parseFloat($(cart_single_price).text());
	let single_total = parseFloat($(cart_single_total).text());

	let qty = $(el).parent('.product_count').children('.qty');
	let val = parseInt( $(qty).val() );
	if(isNaN( val )) return false;

	if (opt=='add') {
		$(qty).val(++val);
		$(cart_single_total).text( (single_total + single_price).toFixed(2));

	}else{
		if(val>1) {
		$(qty).val(--val);
		$(cart_single_total).text( (single_total - single_price).toFixed(2));
	} 
	}

	cart_subtotal();

	}

	function cart_update_keyup(el){
	let single_cart_item = $(el).parent().parent().parent('.single_cart_item');

	let cart_single_price = $(single_cart_item).find('.cart_single_price>.money');
	let cart_single_total = $(single_cart_item).find('.cart_single_total>.money');

	let single_price = parseFloat($(cart_single_price).text());
	let single_total = parseFloat($(cart_single_total).text());

	let val = parseInt( $(el).val() );
	if(isNaN( val )) return false;
	$(cart_single_total).text( (single_price * val).toFixed(2));

	cart_subtotal();
	}

	function cart_subtotal(){
	let total = 0.0;
	$('#cart_item_list>.single_cart_item').each(function(){
		let val = parseFloat($(this).find('.cart_single_total>.money').text());
		if(isNaN( val ) || val == '') return false;
		total += val;
	});
	$('#subtotal_cart_price>.money').text((total).toFixed(2));
	if( $('#discount_price').length ) {
		let discount = parseFloat($('#discount_price>.money').text());
		if(isNaN( discount ) || discount == '') return false;

		let price = total-discount;
		if(price<0) price = 0;
		$('#total_price>.money').text((price).toFixed(2));
	}
	}
	cart_subtotal();
		
	})(jQuery);
</script>
@endpush