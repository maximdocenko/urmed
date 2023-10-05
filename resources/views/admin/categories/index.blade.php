@extends("admin.app")
@section("content")
    <ul id="tree1">
        @foreach($categories as $category)
		    <li>
                {{ json_decode($category->title)->ru }}
		        @if(count($category->childs))
		            @include('admin.categories.manageChild',['childs' => $category->childs])
		        @endif
		    </li>
		@endforeach
    </ul>
@endsection