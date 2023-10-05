@extends("app")

@section("content")

    @include("partials.orders", [
        'orders' => $orders
    ])

@endsection
