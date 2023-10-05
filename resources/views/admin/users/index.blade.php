@extends("admin.app")
@section("content")
    <table class="table">
        <tr>
            <td>#</td>
            <td>image</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Balance</td>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><img class="ava" src="{{ url("images/ava", $user->photo) }}" alt=""></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->balance }}</td>
            </tr>
        @endforeach
    </table>
@endsection