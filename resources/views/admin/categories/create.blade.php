@extends("admin.app")
@section("content")
        <form method="POST" enctype="multipart/form-data" action="{{ route("categories.store") }}">
            @csrf

            @if(session()->get("success"))
                <div class="alert alert-success">{{ session()->get("success") }}</div>
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <div class="form-group">
                <label for="">title</label>
                <input type="text" name="title[ru]" class="form-control">
                <input type="text" name="title[uz]" class="form-control">
                <input type="text" name="title[en]" class="form-control">
            </div>

            <div class="form-group">
                <label for="">image</label>
                <input multiple type="file" name="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="">select</label>
                <ul>
                    @foreach($categories as $category)
                        <li>
                            <input value="{{$category->id}}" type="radio" name="parent_id">({{$category->id}}) {{ json_decode($category->title)->ru }}
                            @if(count($category->childs))
                                @include('admin.categories.manageChildOption',['childs' => $category->childs])
                            @endif
                        </li>
                    @endforeach
                    </ul>
            </div>

            <input type="submit" value="Отправить">
        </form>
    @endsection
