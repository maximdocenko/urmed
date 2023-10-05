@extends("app")

@section("content")

    <div class="pd">
        <div class="container container-secondary">
            <div class="report-details">
                <h3>Консультация #123</h3>
                <span>26 марта 2023 г. в 11:26</span>
                <a class="button float-right" href="">Посмотреть чек</a>
            </div>

            <div class="row row-pd no-gutters">
                <div class="col-lg-12 col-pd">
                    <div class="user report-user">
                        <div class="user-ava">
                            <a href="{{ url("expert") }}">
                                <img src="{{ url("images/user.png") }}" alt="">
                            </a>
                        </div>
                        <div class="user-content">
                            <div class="user-title">
                                <a href="{{ url("expert") }}">Test</a>
                            </div>
                            <div class="user-data">
                                <p class="user-description">
                                    Клиника «MedOsmotr»
                                    Консультация: 50 000 сум
                                </p>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-0">Ваша оценка</h3>
                    <form method="POST" action="{{ url("rating") }}">
                        @csrf
                        <input type="hidden" name="expert_id" value="{{ 1 }}">
                        <div class="user-rating">
                            <div class="rate full">

                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text"></label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text"></label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text"></label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text"></label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text"></label>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Комментарий</label>
                            <textarea class="form-control" name="comment"></textarea>
                        </div>

                        <p class="text-center">
                            <input class="btn" type="submit" value="Оценить">
                        </p>
                    </form>

                </div>
            </div>

        </div>
    </div>


@endsection
