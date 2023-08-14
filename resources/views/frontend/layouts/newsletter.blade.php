<!-- Inicio del Boletín de Noticias de la Tienda -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Inicio del Contenido del Boletín de Noticias -->
                    <div class="inner">
                        <h4>Boletín de Noticias</h4>
                        <p>Suscríbete a nuestro boletín de noticias y obtén un <span>10%</span> de descuento en tu primera compra</p>
                        <form action="{{route('subscribe')}}" method="post" class="newsletter-inner">
                            @csrf
                            <input name="email" placeholder="Tu dirección de correo electrónico" required="" type="email">
                            <button class="btn" type="submit">Suscribirse</button>
                        </form>
                    </div>
                    <!-- Fin del Contenido del Boletín de Noticias -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fin del Boletín de Noticias de la Tienda -->
