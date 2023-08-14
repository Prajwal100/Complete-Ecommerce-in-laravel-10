@extends('frontend.layouts.master')
@section('title', 'Página de Carrito')
@section('main-content')
    <!-- Migas de Pan (Breadcrumbs) -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Inicio<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">Carrito</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de Migas de Pan (Breadcrumbs) -->

    <!-- Carrito de Compras -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Resumen de Compra -->
                    <table class="table shopping-summery">
                        <thead>
                            <tr class="main-hading">
                                <th>PRODUCTO</th>
                                <th>NOMBRE</th>
                                <th class="text-center">PRECIO UNITARIO</th>
                                <th class="text-center">CANTIDAD</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                            </tr>
                        </thead>
                        <tbody id="cart_item_list">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                @if(Helper::getAllProductFromCart())
                                    @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                        <tr>
                                            @php
                                            $photo = explode(',', $cart->product['photo']);
                                            @endphp
                                            <td class="image" data-title="No"><img src="{{ $photo[0] }}" alt="{{ $photo[0] }}"></td>
                                            <td class="product-des" data-title="Descripción">
                                                <p class="product-name"><a href="{{ route('product-detail', $cart->product['slug']) }}" target="_blank">{{ $cart->product['title'] }}</a></p>
                                                <p class="product-des">{!! ($cart['summary']) !!}</p>
                                            </td>
                                            <td class="price" data-title="Precio"><span>${{ number_format($cart['price'], 2) }}</span></td>
                                            <td class="qty" data-title="Cantidad"><!-- Cantidad de Entrada -->
                                                <div class="input-group">
                                                    <div class="button minus">
                                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[{{$key}}]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="quant[{{$key}}]" class="input-number"  data-min="1" data-max="100" value="{{ $cart->quantity }}">
                                                    <input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
                                                    <div class="button plus">
                                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$key}}]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!--/ Fin de Cantidad de Entrada -->
                                            </td>
                                            <td class="total-amount cart_single_price" data-title="Total"><span class="money">${{ $cart['amount'] }}</span></td>

                                            <td class="action" data-title="Eliminar"><a href="{{ route('cart-delete', $cart->id) }}"><i class="ti-trash remove-icon"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <track>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="float-right">
                                            <button class="btn float-right" type="submit">Actualizar</button>
                                        </td>
                                    </track>
                                @else
                                    <tr>
                                        <td class="text-center">
                                            No hay carritos disponibles. <a href="{{ route('product-grids') }}" style="color:blue;">Continuar comprando</a>

                                        </td>
                                    </tr>
                                @endif

                            </form>
                        </tbody>
                    </table>
                    <!--/ Fin de Resumen de Compra -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total del Monto -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="{{ route('coupon-store') }}" method="POST">
                                            @csrf
                                            <input name="code" placeholder="Ingresa tu cupón">
                                            <button class="btn">Aplicar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul>
                                        <li class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">Subtotal del Carrito<span>${{ number_format(Helper::totalCartPrice(), 2) }}</span></li>

                                        @if(session()->has('coupon'))
                                        <li class="coupon_price" data-price="{{ Session::get('coupon')['value'] }}">Ahorras<span>${{ number_format(Session::get('coupon')['value'], 2) }}</span></li>
                                        @endif
                                        @php
                                            $total_amount = Helper::totalCartPrice();
                                            if(session()->has('coupon')){
                                                $total_amount = $total_amount - Session::get('coupon')['value'];
                                            }
                                        @endphp
                                        @if(session()->has('coupon'))
                                            <li class="last" id="order_total_price">Total a Pagar<span>${{ number_format($total_amount, 2) }}</span></li>
                                        @else
                                            <li class="last" id="order_total_price">Total a Pagar<span>${{ number_format($total_amount, 2) }}</span></li>
                                        @endif
                                    </ul>
                                    <div class="button5">
                                        <a href="{{ route('checkout') }}" class="btn">Pagar</a>
                                        <a href="{{ route('product-grids') }}" class="btn">Continuar comprando</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Fin de Total del Monto -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Fin de Carrito de Compras -->

    <!-- Inicio de Área de Servicios de la Tienda -->
    <section class="shop-services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Inicio de Servicio Individual -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Envío Gratis</h4>
                        <p>Pedidos superiores a $100</p>
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

    <!-- Inicio de Boletín de la Tienda -->
    @include('frontend.layouts.newsletter')
    <!-- Fin de Boletín de la Tienda -->

@endsection
@push('styles')
    <style>
        li.shipping{
            display: inline-flex;
            width: 100%;
            font-size: 14px;
        }
        li.shipping .input-group-icon {
            width: 100%;
            margin-left: 10px;
        }
        .input-group-icon .icon {
            position: absolute;
            left: 20px;
            top: 0;
            line-height: 40px;
            z-index: 3;
        }
        .form-select {
            height: 30px;
            width: 100%;
        }
        .form-select .nice-select {
            border: none;
            border-radius: 0px;
            height: 40px;
            background: #f6f6f6 !important;
            padding-left: 45px;
            padding-right: 40px;
            width: 100%;
        }
        .list li{
            margin-bottom:0 !important;
        }
        .list li:hover{
            background:#F7941D !important;
            color:white !important;
        }
        .form-select .nice-select::after {
            top: 14px;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('frontend/js/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() { $("select.select2").select2(); });
        $('select.nice-select').niceSelect();
    </script>
    <script>
        $(document).ready(function(){
            $('.shipping select[name=shipping]').change(function(){
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                // alert(coupon);
                $('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
            });

        });

    </script>

@endpush
