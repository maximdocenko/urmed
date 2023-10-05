<ul>
@foreach($childs as $child)
	<li>
	    {{ json_decode($child->title)->ru }}
	    @if(count($child->childs))
            @include('admin.categories.manageChild', ['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>