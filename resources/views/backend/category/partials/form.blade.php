@include('backend.layouts.notification')
@if($category->exists)
    <form class="form-horizontal" method="POST" action="{{ route('categories.update',$category) }}"
          enctype="multipart/form-data">
        @method('put')
        @csrf
        @else
            <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @endif
                <div class="form-group">
                    <label for="title" class="control-label">{{trans('messages.title')}}</label>

                    <input id="title" class="form-control" type="text" name="title"
                           placeholder="{{trans('messages.enter_category_title')}}"
                           value="{{ old('title', $category->title ?? null) }}"/>
                </div>
                @if ($categories == !null)
                    @if($categories>2)
                        <div class="form-group">
                            <label for="name" class="control-label">{{trans('messages.sub_category')}}</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                @if (!empty($category->title))
                                    <option
                                        value="{{ $category->id }}"
                                        selected>{{ old('title', $category->title ?? null) }}</option>
                                @else
                                    <option value="">Select category</option>
                                @endif
                                @if ($categories)
                                    @foreach ($categories as $categoryList)
                                        <option value="{{ $categoryList['id'] }}">{{ $categoryList['title'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                @endif
                <div class="form-group">
                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn">@lang('messages.save')</button>
                        </div>
                    </div>
                </div>
            </form>
    </form>
