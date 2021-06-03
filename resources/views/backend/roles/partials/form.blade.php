@if ($role->exists)
<form class="form-horizontal" method="POST" action="{{ route('roles.update', $role) }}" enctype="multipart/form-data">
    @method('put')
    @csrf
    @else
    <form class="form-horizontal" method="POST" action="{{ route('role.store') }}" enctype="multipart/form-data">
        @csrf
        @endif
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" id="name" value="{{ $role->name ?? null }}" name="name" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permission:</strong>
                    <br />
                    @foreach ($permission as $permission)
                    <label>
                        <label for="{{ $permission->id }}">
                            <input id="{{ $permission->id }}" name="permission[]" type="checkbox"
                                value="{{ $permission->id }}" @if ($role->permissions->contains($permission->id))
                            checked=checked @endif> {{ $permission->name }}
                        </label><br>
                        @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn purple">{{ trans('messages.save') }}</button>
            </div>
        </div>
    </form>