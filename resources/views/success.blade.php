@extends("app")

@section("content")

    <div class="pd">
        <div class="container">
            <div class="check text-center">
                <img src="{{ url("images/success.svg") }}" alt="">
                <h2>Вы записаны!</h2>
                <p>Lorem ipsum dolor sit amet consectetur. Suscipit purus tellus aliquam eget a<br/> donec ultricies amet.</p>
                <p>
                    <a href="{{ url("account/orders") }}" class="btn">Отчеты</a>
                </p>
            </div>
        </div>
    </div>

@endsection
