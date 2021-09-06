@extends('backend.layouts.master')
@section('main-content')

    <div class="container-fluid">
        <div class="content">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title "> {{trans('messages.ads_section')}}</h4>
                    <p class="card-category"><a href="{{ route('admin')}}">{{trans('messages.home')}}</a> -> <a
                                href="{{route('categories.index')}}">{{trans('messages.ads_section')}}</a></p>
                </div>
                <div class="card-body">
                    @include('backend.category.partials.form')
                </div>
            </div>
        </div>
    </div>
@stop
