@extends("app")

@section("content")

    <div class="pd">
        <div class="container container-secondary">
            <div class="row">
                <div class="col-lg-6">
                    <div class="user-image">
                        <img src="{{ url("images/user.png") }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="user-title large">
                        <a href="">{{ $item->name }}</a>
                    </div>

                        <div class="user-rating">
                            <div class="rate">

                                <label for="star5" title="text"></label>
                                <label for="star4" title="text"></label>
                                <label for="star3" title="text"></label>
                                <label for="star2" title="text"></label>
                                <label for="star1" title="text"></label>

                            </div>
                            <span>5.0</span>
                        </div>


                    <p class="user-description">Стаж {{ $exp ?? '' }} года</p>
                    @include("partials.services", ['item' => $item])
                    <p class="user-description">
                        {{ __("messages.place_of_work") }}: {{ meta($item->meta, "place_of_work") }}
                    </p>


                    <div class="hr"></div>
                    <p class="price">
                        Стоимость консультации
                        <span>{{ number_format($item->price, 0, " ", " ") }} сум</span>
                    </p>

                    <p>
                        <a href="{{ url("order", $item->unique_id) }}" class="btn">Записаться</a>
                    </p>

                </div>


                <div class="col-lg-12">
                    <div class="content">
                        @foreach($item->meta as $meta)
                            @if(in_array($meta->key, ['qualification', 'education', 'training']))
                                @if($meta->value)
                                    <h3>{{ __("messages." . $meta->key) }}</h3>
                                    <p>{{ $meta->value }}</p>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
