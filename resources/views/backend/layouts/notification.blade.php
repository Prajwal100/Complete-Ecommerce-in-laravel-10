@if(session('success'))
    <div class="alert alert-success alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('success')}}
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('error')}}
    </div>
@endif
@if(Session::has('success_msg'))
    <div class="alert alert-success">
        <strong>{{trans('messages.success')}}!</strong> {!! Session::get('success_msg') !!}
    </div>
@endif

@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert-primary">{{ $error }}</div>
    @endforeach
@endif
