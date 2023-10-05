@extends("app")

@section("content")

    <div class="experts pd">
        <div class="container">
            <h3>Наши терапевты</h3>
            <div class="row row-pd no-gutters">
                @foreach($data as $item)
                    @include("partials.user", ['item' => $item])
                @endforeach
            </div>
        </div>
    </div>


@endsection
