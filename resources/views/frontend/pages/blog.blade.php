@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Página de Blog')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Inicio<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Blog con Cuadrícula y Barra Lateral</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de Breadcrumbs -->

    <!-- Inicio de Entradas Individuales del Blog -->
    <section class="blog-single shop-blog grid section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Inicio de Entrada Individual del Blog -->
                                <div class="shop-single-blog">
                                    <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                    <div class="content">
                                        <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> {{$post->created_at->format('d M, Y. D')}}
                                            <span class="float-right">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                 {{$post->author_info->name ?? 'Anónimo'}}
                                            </span>
                                        </p>
                                        <a href="{{route('blog.detail',$post->slug)}}" class="title">{{$post->title}}</a>
                                        <p>{!! html_entity_decode($post->summary) !!}</p>
                                        <a href="{{route('blog.detail',$post->slug)}}" class="more-btn">Seguir Leyendo</a>
                                    </div>
                                </div>
                                <!-- Fin de Entrada Individual del Blog -->
                            </div>
                        @endforeach
                        <div class="col-12">
                            <!-- Paginación -->
                            {{-- {{$posts->appends($_GET)->links()}} --}}
                            <!--/ Fin de Paginación -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Widget Individual -->
                        <div class="single-widget search">
                            <form class="form" method="GET" action="{{route('blog.search')}}">
                                <input type="text" placeholder="Buscar aquí..." name="search">
                                <button class="button" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!--/ Fin de Widget Individual -->
                        <!-- Widget Individual -->
                        <div class="single-widget category">
                            <h3 class="title">Categorías del Blog</h3>
                            <ul class="categor-list">
                                @if(!empty($_GET['category']))
                                    @php
                                        $filter_cats=explode(',',$_GET['category']);
                                    @endphp
                                @endif
                                <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    @foreach(Helper::postCategoryList('posts') as $cat)
                                        <li>
                                            <a href="{{route('blog.category',$cat->slug)}}">{{$cat->title}} </a>
                                        </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                        <!--/ Fin de Widget Individual -->
                        <!-- Widget Individual -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Entradas Recientes</h3>
                            @foreach($recent_posts as $post)
                                <!-- Entrada Individual -->
                                <div class="single-post">
                                    <div class="image">
                                        <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                    </div>
                                    <div class="content">
                                        <h5><a href="#">{{$post->title}}</a></h5>
                                        <ul class="comment">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$post->created_at->format('d M, y')}}</li>
                                            <li><i class="fa fa-user" aria-hidden="true"></i>
                                                {{$post->author_info->name ?? 'Anónimo'}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Fin de Entrada Individual -->
                            @endforeach
                        </div>
                        <!--/ Fin de Widget Individual -->
                        <!-- Widget Individual -->
                        <div class="single-widget side-tags">
                            <h3 class="title">Etiquetas</h3>
                            <ul class="tag">
                                @if(!empty($_GET['tag']))
                                    @php
                                        $filter_tags=explode(',',$_GET['tag']);
                                    @endphp
                                @endif
                                <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    @foreach(Helper::postTagList('posts') as $tag)
                                        <li>
                                            <a href="{{route('blog.tag',$tag->title)}}">{{$tag->title}} </a>
                                        </li>
                                    @endforeach
                                </form>
                            </ul>
                        </div>
                        <!--/ Fin de Widget Individual -->
                        <!-- Widget Individual -->
                        <div class="single-widget newsletter">
                            <h3 class="title">Boletín de Noticias</h3>
                            <div class="letter-inner">
                                <h4>Suscríbete y recibe noticias <br> y las últimas actualizaciones.</h4>
                                <form method="POST" action="{{route('subscribe')}}" class="form-inner">
                                    @csrf
                                    <input type="email" name="email" placeholder="Ingresa tu correo electrónico">
                                    <button type="submit" class="btn " style="width: 100%">Enviar</button>
                                </form>
                            </div>
                        </div>
                        <!--/ Fin de Widget Individual -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Fin de Entradas Individuales del Blog -->
@endsection

@push('styles')
    <style>
        .pagination{
            display:inline-flex;
        }
    </style>
@endpush
