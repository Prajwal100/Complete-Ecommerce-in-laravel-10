@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Acerca de Nosotros')

@section('main-content')

	<!-- Migas de Pan (Breadcrumbs) -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Inicio<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">Acerca de Nosotros</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin de Migas de Pan (Breadcrumbs) -->

	<!-- Acerca de Nosotros -->
	<section class="about-us section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							@php
								$settings = DB::table('settings')->get();
							@endphp
							<h3>Bienvenido a <span>Eshop</span></h3>
							<p>@foreach($settings as $data) {{$data->description}} @endforeach</p>
							<div class="button">
								<a href="{{route('blog')}}" class="btn">Nuestro Blog</a>
								<a href="{{route('contact')}}" class="btn primary">Contáctanos</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="about-img overlay">
							{{-- <div class="button">
								<a href="https://www.youtube.com/watch?v=nh2aYrGMrIE" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
							</div> --}}
							<img src="@foreach($settings as $data) {{$data->photo}} @endforeach" alt="@foreach($settings as $data) {{$data->photo}} @endforeach">
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- Fin de Acerca de Nosotros -->

	<!-- Inicio de Área de Servicios de la Tienda -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Envío Gratuito</h4>
						<p>Para pedidos superiores a $100</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Devolución Gratuita</h4>
						<p>Devoluciones en un plazo de 30 días</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Pago Seguro</h4>
						<p>Pago 100% seguro</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Inicio de Servicio Individual -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Mejor Precio</h4>
						<p>Precio garantizado</p>
					</div>
					<!-- Fin de Servicio Individual -->
				</div>
			</div>
		</div>
	</section>
	<!-- Fin de Área de Servicios de la Tienda -->

	@include('frontend.layouts.newsletter')
@endsection
