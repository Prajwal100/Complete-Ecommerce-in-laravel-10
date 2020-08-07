@if(isset($category_lists))
<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($category_lists as $category)
    {{-- {{$category}} --}}
<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#hello" role="tab">{{$category->title}}</a></li>
    @endforeach
</ul>
@endif