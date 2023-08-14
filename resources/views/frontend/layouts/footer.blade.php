	<!-- Comienza el Área del Pie de Página -->
	<footer class="footer">
		<!-- Parte Superior del Pie de Página -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Widget Individual -->
						<div class="single-footer about">
							<div class="logo">
								<a href="index.html"><img src="{{asset('backend/img/logo2.png')}}" alt="#"></a>
							</div>
							@php
								$settings=DB::table('settings')->get();
							@endphp
							<p class="text">@foreach($settings as $data) {{$data->short_des}} @endforeach</p>
							<p class="call">¿Tienes alguna pregunta? Llámanos 24/7<span><a href="tel:123456789">@foreach($settings as $data) {{$data->phone}} @endforeach</a></span></p>
						</div>
						<!-- Fin del Widget Individual -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Widget Individual -->
						<div class="single-footer links">
							<h4>Información</h4>
							<ul>
								<li><a href="{{route('about-us')}}">Sobre Nosotros</a></li>
								<li><a href="#">Preguntas Frecuentes</a></li>
								<li><a href="#">Términos y Condiciones</a></li>
								<li><a href="{{route('contact')}}">Contáctanos</a></li>
								<li><a href="#">Ayuda</a></li>
							</ul>
						</div>
						<!-- Fin del Widget Individual -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Widget Individual -->
						<div class="single-footer links">
							<h4>Servicio al Cliente</h4>
							<ul>
								<li><a href="#">Métodos de Pago</a></li>
								<li><a href="#">Devolución de Dinero</a></li>
								<li><a href="#">Devoluciones</a></li>
								<li><a href="#">Envío</a></li>
								<li><a href="#">Política de Privacidad</a></li>
							</ul>
						</div>
						<!-- Fin del Widget Individual -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Widget Individual -->
						<div class="single-footer social">
							<h4>Contáctanos</h4>
							<!-- Widget Individual -->
							<div class="contact">
								<ul>
									<li>@foreach($settings as $data) {{$data->address}} @endforeach</li>
									<li>@foreach($settings as $data) {{$data->email}} @endforeach</li>
									<li>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
								</ul>
							</div>
							<!-- Fin del Widget Individual -->
							<div class="sharethis-inline-follow-buttons"></div>
						</div>
						<!-- Fin del Widget Individual -->
					</div>
				</div>
			</div>
		</div>
		<!-- Fin de la Parte Superior del Pie de Página -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Derechos de Autor © {{date('Y')}} <a href="https://github.com/Prajwal100" target="_blank">Prajwal Rai</a> - Todos los Derechos Reservados.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{asset('backend/img/payments.png')}}" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /Fin del Área del Pie de Página -->

	<!-- Jquery -->
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('frontend/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('frontend/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('frontend/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
	{{-- Isotope --}}
	<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('frontend/js/easing.js')}}"></script>

	<!-- Active JS -->
	<script src="{{asset('frontend/js/active.js')}}"></script>

	
	@stack('scripts')
	<script>
		setTimeout(function(){
		  $('.alert').slideUp();
		},5000);
		$(function() {
		// ------------------------------------------------------- //
		// Menús desplegables de varios niveles
		// ------------------------------------------------------ //
			$("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
				event.preventDefault();
				event.stopPropagation();

				$(this).siblings().toggleClass("show");


				if (!$(this).next().hasClass('show')) {
				$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
				}
				$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
				$('.dropdown-submenu .show').removeClass("show");
				});

			});
		});
	  </script>
