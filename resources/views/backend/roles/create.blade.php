@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="content" style="margin-top: 7%">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title "> {{trans('messages.manage_posts')}}</h4>
                    <p class="card-category"><a href="{{ route('dashboard')}}">{{trans('messages.home')}}</a> -> <a
                                href="{{route('posts.index')}}">{{trans('messages.posts')}}</a></p>
                </div>
                <div class="card-body">
                    @include('admin.roles.partials.form')
                </div>
            </div>
        </div>
    </div>
@endsection

