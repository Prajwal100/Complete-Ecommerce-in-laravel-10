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
                        {{ Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT','id'=>'form-username','class'=>'form-horizontal form-bordered', 'files'=>true]) }}
                        @include('backend.users.partials.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
