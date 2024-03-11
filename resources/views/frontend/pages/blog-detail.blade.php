@extends('frontend.layouts.master')

@section('title', 'E-TECH || Página de Detalle del Blog')

@section('main-content')
    <!-- Migas de Pan (Breadcrumbs) -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Inicio<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Blog Individual con Barra Lateral</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de Migas de Pan (Breadcrumbs) -->

    <!-- Inicio de Blog Individual -->
    <section class="blog-single section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                <div class="image">
                                    <img src="{{ $post->photo }}" alt="{{ $post->photo }}">
                                </div>
                                <div class="blog-detail">
                                    <h2 class="blog-title">{{ $post->title }}</h2>
                                    <div class="blog-meta">
                                        <span class="author"><a href="javascript:void(0);"><i class="fa fa-user"></i>Por {{ $post->author_info['name'] }}</a><a href="javascript:void(0);"><i class="fa fa-calendar"></i>{{ $post->created_at->format('d M, Y') }}</a><a href="javascript:void(0);"><i class="fa fa-comments"></i>Comentario ({{ $post->allComments->count() }})</a></span>
                                    </div>
                                    <div class="sharethis-inline-reaction-buttons"></div>
                                    <div class="content">
                                        @if($post->quote)
                                        <blockquote> <i class="fa fa-quote-left"></i> {!! ($post->quote) !!}</blockquote>
                                        @endif
                                        <p>{!! ($post->description) !!}</p>
                                    </div>
                                </div>
                                <div class="share-social">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="content-tags">
                                                <h4>Etiquetas:</h4>
                                                <ul class="tag-inner">
                                                    @php
                                                        $tags = explode(',', $post->tags);
                                                    @endphp
                                                    @foreach($tags as $tag)
                                                    <li><a href="javascript:void(0);">{{ $tag }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @auth
                            <div class="col-12 mt-4">
                                <div class="reply">
                                    <div class="reply-head comment-form" id="commentFormContainer">
                                        <h2 class="reply-title">Dejar un Comentario</h2>
                                        <!-- Formulario de Comentario -->
                                        <form class="form comment_form" id="commentForm" action="{{ route('post-comment.store', $post->slug) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                {{-- <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Tu Nombre<span>*</span></label>
                                                        <input type="text" name="name" placeholder="" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Tu Correo Electrónico<span>*</span></label>
                                                        <input type="email" name="email" placeholder="" required="required">
                                                    </div>
                                                </div> --}}
                                                <div class="col-12">
                                                    <div class="form-group  comment_form_body">
                                                        <label>Tu Mensaje<span>*</span></label>
                                                        <textarea name="comment" id="comment" rows="10" placeholder=""></textarea>
                                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                                        <input type="hidden" name="parent_id" id="parent_id" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button">
                                                        <button type="submit" class="btn"><span class="comment_btn comment">Publicar Comentario</span><span class="comment_btn reply" style="display: none;">Responder Comentario</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- Fin de Formulario de Comentario -->
                                    </div>
                                </div>
                            </div>
                            @else
                            <p class="text-center p-5">
                                Necesitas <a href="{{ route('login.form') }}" style="color: rgb(54, 54, 204)">Iniciar sesión</a> O <a style="color: blue" href="{{ route('register.form') }}">Registrarte</a> para comentar.
                            </p>
                            <!--/ Fin del Formulario -->
                            @endauth
                            <div class="col-12">
                                <div class="comments">
                                    <h3 class="comment-title">Comentarios ({{ $post->allComments->count() }})</h3>
                                    <!-- Comentario Individual -->
                                    @include('frontend.pages.comment', ['comments' => $post->comments, 'post_id' => $post->id, 'depth' => 3])
                                    <!-- Fin del Comentario Individual -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Widget Individual -->
                        <div class="single-widget search">
                            <form class="form" method="GET" action="{{ route('blog.search') }}">
                                <input type="text" placeholder="Buscar aquí..." name="search">
                                <button class="button" type="sumbit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!--/ Fin del Widget Individual -->
                        <!-- Widget Individual -->
                        <div class="single-widget category">
                            <h3 class="title">Categorías del Blog</h3>
                            <ul class="categor-list">
                                {{-- {{count(Helper::postCategoryList())}} --}}
                                @foreach(Helper::postCategoryList('posts') as $cat)
                                <li><a href="#">{{ $cat->title }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--/ Fin del Widget Individual -->
                        <!-- Widget Individual -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Entradas Recientes</h3>
                            @foreach
