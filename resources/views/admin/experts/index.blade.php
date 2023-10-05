@extends("admin.app")
@section("content")
    <table class="table">
        <tr>
            <td>#</td>
            <td>image</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Email</td>
        </tr>
        @foreach($experts as $expert)
            <tr>
                <td>{{ $expert->id }}</td>
                <td><img class="ava" src="{{ url("images/ava", $expert->photo) }}" alt=""></td>
                <td>{{ $expert->name }}</td>
                <td>{{ $expert->phone }}</td>
                <td>{{ $expert->email }}</td>
            </tr>
        @endforeach
    </table>
@endsection