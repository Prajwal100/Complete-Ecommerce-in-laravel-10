@extends('frontend.layouts.master')

@section('title','E-SHOP || Página de Seguimiento de Orden')

@section('main-content')
    <!-- Migas de Pan -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Inicio<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Seguimiento de Orden</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de las Migas de Pan -->
<section class="tracking_box_area section_gap py-5">
    <div class="container">
        <div class="tracking_box_inner">
            <p>Para hacer el seguimiento de tu orden, por favor ingresa tu ID de Orden en el cuadro de abajo y presiona el botón "Seguimiento". Esto te fue proporcionado en tu recibo y en el correo de confirmación que debiste haber recibido.</p>
            <form class="row tracking_form my-4" action="{{route('product.track.order')}}" method="post" novalidate="novalidate">
              @csrf
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control p-2"  name="order_number" placeholder="Ingresa tu número de orden">
                </div>
                <div class="col-md-8 form-group">
                    <button type="submit" value="submit" class="btn submit_btn">Seguimiento de Orden</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
