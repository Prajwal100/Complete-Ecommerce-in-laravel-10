@extends('backend.layouts.master')

@section('title','Admin Profile')

@section('main-content')

    <div class="container-fluid">
        <div class="content">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title "> {{trans('messages.dashboard')}}</h4>
                    <p class="card-category"><a href="{{ route('admin')}}">{{trans('messages.dashboard')}}</a>
                        ->
                        <a
                                href="{{route('users.index')}}">{{trans('messages.users')}}</a></p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        {!! Form::open(['route' => 'users.store','method'=>'POST']) !!}
                        @include('backend.users.partials.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
