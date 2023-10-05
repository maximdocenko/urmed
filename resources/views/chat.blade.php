@extends("app")

@section("styles")
    <link rel="stylesheet" href="{{url('css/chat.css')}}">
@endsection

@section("content")

    @include("partials.chat")

@endsection
