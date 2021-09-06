<div class="col-xs-12 col-sm-12 col-md-12">

    <strong>@lang('messages.name'):</strong>
    <input id="name" class="form-control" placeholder="name" name="name" type="text"
           value=" {{ old('name', $user->name ?? null) }}">
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <strong>@lang('messages.email'):</strong>
    <input id="email" class="form-control" placeholder="email" name="email" type="email"
           value=" {{ old('email', $user->email ?? null) }}">
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <strong>Password:</strong>
    <div class="form-group">
        <input id="password" class="form-control" placeholder="password" name="password" type="password">
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <strong>Confirm Password:</strong>
    <div class="form-group">
        <input id="password" class="form-control" placeholder="Confirm Password" name="confirm-password"
               type="password">
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <strong>Role:</strong>
    <div class="form-group">
        <select data-placeholder="Select a Roles" class="form-control js-example-basic-multiple" name="roles[]"
                multiple="multiple">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                    {{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    {{ Form::submit(trans('messages.save'), ['name' => 'submit', 'class'=>'btn purple' ]) }}
</div>
{!! Form::close() !!}
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>$(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
