@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="tienda en línea, compra, carrito, sitio de comercio electrónico, mejor compra en línea">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection

@section('title','E-SHOP || DETALLE DEL PRODUCTO')
@section('main-content')
	<!-- Migas de Pan -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Inicio<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Detalles del Producto</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin de las Migas de Pan -->

	<!-- Producto Individual -->
	<section class="shop single section">
		<div class="container">
			<div class="row"> 
				<div class="col-12">
					<div class="row">
						<div class="col-lg-6 col-12">
							<!-- Deslizador de Producto -->
							<div class="product-gallery">
								<!-- Deslizador de Imágenes -->
								<div class="flexslider-thumbnails">
									<ul class="slides">
										@php 
											$photo=explode(',',$product_detail->photo);
										@endphp
										@foreach($photo as $data)
											<li data-thumb="{{$data}}" rel="adjustX:10, adjustY:">
												<img src="{{$data}}" alt="{{$data}}">
											</li>
										@endforeach
									</ul>
								</div>
								<!-- Fin del Deslizador de Imágenes -->
							</div>
							<!-- Fin del Deslizador de Producto -->
						</div>
						<div class="col-lg-6 col-12">
							<div class="product-des">
								<!-- Descripción -->
								<div class="short">
									<h4>{{$product_detail->title}}</h4>
									<div class="rating-main">
										<ul class="rating">
											@php
												$rate=ceil($product_detail->getReview->avg('rate'))
											@endphp
											@for($i=1; $i<=5; $i++)
												@if($rate>=$i)
													<li><i class="fa fa-star"></i></li>
												@else 
													<li><i class="fa fa-star-o"></i></li>
												@endif
											@endfor
										</ul>
										<a href="#" class="total-review">({{$product_detail['getReview']->count()}}) Opiniones</a>
									</div>
									@php 
										$after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
									@endphp
									<p class="price"><span class="discount">${{number_format($after_discount,2)}}</span><s>${{number_format($product_detail->price,2)}}</s> </p>
									<p class="description">{!!($product_detail->summary)!!}</p>
								</div>
								<!--/ Fin de la Descripción -->
								<!-- Talla -->
								@if($product_detail->size)
									<div class="size mt-4">
										<h4>Talla</h4>
										<ul>
											@php 
												$sizes=explode(',',$product_detail->size);
											@endphp
											@foreach($sizes as $size)
												<li><a href="#" class="one">{{$size}}</a></li>
											@endforeach
										</ul>
									</div>
								@endif
								<!--/ Fin de la Talla -->
								<!-- Compra de Producto -->
								<div class="product-buy">
									<form action="{{route('single-add-to-cart')}}" method="POST">
										@csrf 
										<div class="quantity">
											<h6>Cantidad :</h6>
											<!-- Cantidad de Entrada -->
											<div class="input-group">
												<div class="button minus">
													<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
														<i class="ti-minus"></i>
													</button>
													</div>
													<input type="hidden" name="slug" value="{{$product_detail->slug}}">
													<input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1" id="quantity">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
															<i class="ti-plus"></i>
														</button>
													</div>
											</div>
											<!--/ Fin de la Cantidad de Entrada -->
										</div>
										<div class="add-to-cart mt-4">
											<button type="submit" class="btn">Añadir al Carrito</button>
											<a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min"><i class="ti-heart"></i></a>
										</div>
									</form>

									<p class="cat">Categoría :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}</a></p>
									@if($product_detail->sub_cat_info)
									<p class="cat mt-1">Subcategoría :<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}">{{$product_detail->sub_cat_info['title']}}</a></p>
									@endif
									<p class="availability">Existencias : @if($product_detail->stock>0)<span class="badge badge-success">{{$product_detail->stock}}</span>@else <span class="badge badge-danger">{{$product_detail->stock}}</span>  @endif</p>
								</div>
								<!--/ Fin de la Compra de Producto -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="product-info">
								<div class="nav-main">
									<!-- Navegación de Pestañas -->
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Descripción</a></li>
										<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Opiniones</a></li>
									</ul>
									<!--/ Fin de la Navegación de Pestañas -->
								</div>
								<div class="tab-content" id="myTabContent">
									<!-- Pestaña de Descripción -->
									<div class="tab-pane fade show active" id="description" role="tabpanel">
										<div class="tab-single">
											<div class="row">
												<div class="col-12">
													<div class="single-des">
														<p>{!! ($product_detail->description) !!}</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--/ Fin de la Pestaña de Descripción -->
									<!-- Pestaña de Opiniones -->
									<div class="tab-pane fade" id="reviews" role="tabpanel">
										<div class="tab-single review-panel">
											<div class="row">
												<div class="col-12">
													
													<!-- Opiniones -->
													<div class="comment-review">
														<div class="add-review">
															<h5>Agregar una Opinión</h5>
															<p>Tu dirección de correo electrónico no será publicada. Los campos requeridos están marcados</p>
														</div>
														<h4>Tu Calificación <span class="text-danger">*</span></h4>
														<div class="review-inner">
															<!-- Formulario -->
															@auth
															<form class="form" method="post" action="{{route('review.store',$product_detail->slug)}}">
																@csrf
																<div class="row">
																	<div class="col-lg-12 col-12">
																		<div class="rating_box">
																			<div class="star-rating">
																				<div class="star-rating__wrap">
																					<input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
																					<label class="star-rating__ico fa fa-star-o" for="star-rating-5" title="5 de 5 estrellas"></label>
																					<input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
																					<label class="star-rating__ico fa fa-star-o" for="star-rating-4" title="4 de 5 estrellas"></label>
																					<input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
																					<label class="star-rating__ico fa fa-star-o" for="star-rating-3" title="3 de 5 estrellas"></label>
																					<input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
																					<label class="star-rating__ico fa fa-star-o" for="star-rating-2" title="2 de 5 estrellas"></label>
																					<input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
																					<label class="star-rating__ico fa fa-star-o" for="star-rating-1" title="1 de 5 estrellas"></label>
																					@error('rate')
																					<span class="text-danger">{{$message}}</span>
																					@enderror
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-12 col-12">
																		<div class="form-group">
																			<label>Escribe una opinión</label>
																			<textarea name="review" rows="6" placeholder="" ></textarea>
																		</div>
																	</div>
																	<div class="col-lg-12 col-12">
																		<div class="form-group button5">	
																			<button type="submit" class="btn">Enviar</button>
																		</div>
																	</div>
																</div>
															</form>
															@else 
															<p class="text-center p-5">
																Debes <a href="{{route('login.form')}}" style="color:rgb(54, 54, 204)">Iniciar Sesión</a> O <a style="color:blue" href="{{route('register.form')}}">Registrarte</a>

															</p>
															<!--/ Fin del Formulario -->
															@endauth
														</div>
													</div>
												
													<div class="ratting-main">
														<div class="avg-ratting">
															{{-- @php 
																$rate=0;
																foreach($product_detail->rate as $key=>$rate){
																	$rate +=$rate
																}
															@endphp --}}
															<h4>{{ceil($product_detail->getReview->avg('rate'))}} <span>(General)</span></h4>
															<span>Basado en {{$product_detail->getReview->count()}} Comentarios</span>
														</div>
														@foreach($product_detail['getReview'] as $data)
														<!-- Calificación Individual -->
														<div class="single-rating">
															<div class="rating-author">
																@if($data->user_info['photo'])
																<img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['photo']}}">
																@else 
																<img src="{{asset('backend/img/avatar.png')}}" alt="Perfil.jpg">
																@endif
															</div>
															<div class="rating-des">
																<h6>{{$data->user_info['name']}}</h6>
																<div class="ratings">

																	<ul class="rating">
																		@for($i=1; $i<=5; $i++)
																			@if($data->rate>=$i)
																				<li><i class="fa fa-star"></i></li>
																			@else 
																				<li><i class="fa fa-star-o"></i></li>
																			@endif
																		@endfor
																	</ul>
																	<div class="rate-count">(<span>{{$data->rate}}</span>)</div>
																</div>
																<p>{{$data->review}}</p>
															</div>
														</div>
														<!--/ Fin de la Calificación Individual -->
														@endforeach
													</div>
													
													<!--/ Fin de las Opiniones -->
													
												</div>
											</div>
										</div>
									</div>
									<!--/ Fin de la Pestaña de Opiniones -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/ Fin del Producto Individual -->
			
			<!-- Inicio de los Productos Relacionados -->
		<div class="product-area most-popular related-product section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Productos Relacionados</h2>
						</div>
					</div>
				</div>
				<div class="row">
					{{-- {{$product_detail->rel_prods}} --}}
					<div class="col-12">
						<div class="owl-carousel popular-slider">
							@foreach($product_detail->rel_prods as $data)
								@if($data->id !==$product_detail->id)
									<!-- Inicio del Producto Individual -->
									<div class="single-product">
										<div class="product-img">
											<a href="{{route('product-detail',$data->slug)}}">
												@php 
													$photo=explode(',',$data->photo);
												@endphp
												<img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
												<img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
												<span class="price-dec">{{$data->discount}} % Descuento</span>
												{{-- <span class="out-of-stock">Hot</span> --}}
											</a>
											<div class="button-head">
												<div class="product-action">
													<a data-toggle="modal" data-target="#modelExample" title="Vista Rápida" href="#"><i class=" ti-eye"></i><span>Vista Rápida</span></a>
													<a title="Lista de Deseos" href="#"><i class=" ti-heart "></i><span>Agregar a la Lista de Deseos</span></a>
													<a title="Comparar" href="#"><i class="ti-bar-chart-alt"></i><span>Agregar a Comparar</span></a>
												</div>
												<div class="product-action-2">
													<a title="Agregar al carrito" href="#">Agregar al carrito</a>
												</div>
											</div>
										</div>
										<div class="product-content">
											<h3><a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a></h3>
											<div class="product-price">
												@php 
													$after_discount=($data->price-(($data->discount*$data->price)/100));
												@endphp
												<span class="old">${{number_format($data->price,2)}}</span>
												<span>${{number_format($after_discount,2)}}</span>
											</div>
											
										</div>
									</div>
									<!--/ Fin del Producto Individual -->
													
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Fin de los Productos Relacionados -->
		
		<!-- Modal -->
		<div class="modal fade" id="modelExample" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span class="ti-close" aria-hidden="true"></span></button>
					</div>
					<div class="modal-body">
						<div class="row no-gutters">
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<!-- Deslizador de Imágenes -->
								<div class="product-gallery">
									<div class="quickview-slider-active">
										<div class="single-slider">
											<img src="assets/images/modal1.jpg" alt="#">
										</div>
										<div class="single-slider">
											<img src="assets/images/modal2.jpg" alt="#">
										</div>
										<div class="single-slider">
											<img src="assets/images/modal3.jpg" alt="#">
										</div>
										<div class="single-slider">
											<img src="assets/images/modal4.jpg" alt="#">
										</div>
									</div>
								</div>
								<!--/ Fin del Deslizador de Imágenes -->
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
											<a href="#"> (1 opinión)</a>
										</div>
										<div class="quickview-stock">
											<span><i class="fa fa-check-circle-o"></i> en Stock</span>
										</div>
									</div>
									<h3>$29.00</h3>
									<div class="quickview-peragraph">
										<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
									</div>
									<div class="size">
										<div class="row">
											<div class="col-lg-6 col-12">
												<h5 class="title">Tamaño</h5>
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
													<option selected="selected">Naranja</option>
													<option>Rosa</option>
													<option>Azul</option>
													<option>Morao</option>
												</select>
											</div>
										</div>
									</div>
									<div class="quantity">
										<!-- Cantidad de Entrada -->
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
										<!--/ Fin de la Cantidad de Entrada -->
									</div>
									<div class="add-to-cart">
										<a href="#" class="btn">Agregar al Carrito</a>
										<a href="#" class="btn min"><i class="ti-heart"></i></a>
										<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
									</div>
									<div class="default-social">
										<h4 class="share-now">Comparte:</h4>
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
					<div class="modal-footer">
						<div class="widget">
							<h6 class="widget-title">Productos Relacionados</h6>
							<ul class="widget-body">
								<li>
									<div class="single-wid-product">
										<a href="shop-grid.html"><img src="assets/images/product/1.jpg" alt="" class="product-thumb"></a>
										<h2><a href="shop-grid.html">Flared Shift Dress</a></h2>
										<div class="widget-body">
											<span class="old">$45.00</span>
											<span class="new">$40.99</span>
										</div>
									</div>
								</li>
								<li>
									<div class="single-wid-product">
										<a href="shop-grid.html"><img src="assets/images/product/2.jpg" alt="" class="product-thumb"></a>
										<h2><a href="shop-grid.html">Flared Shift Dress</a></h2>
										<div class="widget-body">
											<span class="old">$45.00</span>
											<span class="new">$40.99</span>
										</div>
									</div>
								</li>
								<li>
									<div class="single-wid-product">
										<a href="shop-grid.html"><img src="assets/images/product/3.jpg" alt="" class="product-thumb"></a>
										<h2><a href="shop-grid.html">Flared Shift Dress</a></h2>
										<div class="widget-body">
											<span class="old">$45.00</span>
											<span class="new">$40.99</span>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Fin del Modal -->
		
		<!-- Inicio del Boletín -->
		<section class="shop-newsletter section">
			<div class="container">
				<div class="inner-top">
					<div class="row">
						<div class="col-lg-8 offset-lg-2 col-12">
							<!-- Inicio del Titulo -->
							<div class="inner">
								<h4>Boletín</h4>
								<h2>Suscríbete a nuestro boletín para recibir las últimas ofertas</h2>
								<div class="space"></div>
								<form action="{{route('subscriber.store')}}" method="POST" class="subscribe-form">
									@csrf
									<input type="email" name="email" placeholder="Tu correo electrónico">
									<button type="submit" class="btn">Suscríbete Ahora</button>
								</form>
							</div>
							<!-- Fin del Titulo -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ Fin del Boletín -->
@endsection
</div>
</div>
