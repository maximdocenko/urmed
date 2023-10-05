
<ul>
@foreach($childs as $child)
	<li>	
		<input name="parent_id" type="radio" value="{{$child->id}}"> ({{$child->id}}) {{ json_decode($child->title)->ru }}
		@if(count($child->childs))
			@include('admin.categories.manageChildOption', ['childs' => $child->childs])
		@endif
	</li>
@endforeach
</ul>
