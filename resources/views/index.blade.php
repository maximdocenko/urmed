@extends("app")

@section("content")

    @if(auth()->check())
        @if(in_array(auth()->user()->role, ['doctor', 'lawyer']))
            @include("partials.orders", [
                'orders' => $orders
            ])
        @endif
    @endif
    @if(!auth()->check() || auth()->user()->role == 'user')
        <div class="topics btn-margin pd">
            <div class="container">
                <h1 class="title">
                    Темы
                </h1>
                <div class="tabs">
                    <div class="tab active" data-id="1">
                        Врачи
                    </div>
                    <div class="tab" data-id="2">
                        Юристы
                    </div>
                </div>
                <div class="tab-contents">
                    <div class="tab-content" data-id="1">
                        <div class="buttons">
                            <div class="button active" data-id="4">
                                Взрослым
                            </div>
                            <div class="button" data-id="5">
                                Детям
                            </div>
                            <a class="button active float-right">
                                Все
                            </a>
                        </div>
                        <div class="row row-pd no-gutters">
                            @foreach(\App\Models\Category::whereIn("parent_id", [4,5])->orderBy("title")->get() as $item)
                                <div class="col-lg-2 col-pd" data-parent-id="{{ $item->parent_id }}">
                                    <div class="item">
                                        <div class="item-image">
                                            <a href="{{ url("experts", $item->id) }}">
                                                <img src="{{ url("images/uploads", $item->image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="item-title">
                                            <a href="">
                                                {{ json_decode($item->title)->ru }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content" data-id="2">
                        <div class="buttons">
                            <div class="button active" data-id="43">
                                Частным лицам
                            </div>
                            <div class="button" data-id="44">
                                Бизнесу
                            </div>
                            <a class="button float-right">
                                Все
                            </a>
                        </div>
                        <div class="row row-pd no-gutters">
                            @foreach(\App\Models\Category::whereIn("parent_id", [43,44])->orderBy("title")->get() as $item)
                                <div class="col-lg-2 col-pd" data-parent-id="{{ $item->parent_id }}">
                                    <div class="item">
                                        <div class="item-image">
                                            <a href="{{ url("experts", $item->id) }}">
                                                <img src="{{ url("images/uploads", $item->image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="item-title">
                                            <a href="{{ url("experts", $item->id) }}">
                                                {{ json_decode($item->title)->ru }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <p class="text-center">
                    <a href="" class="btn">Смотреть все</a>
                </p>
            </div>
        </div>

        <div class="container">
            <div class="banner">
                <img src="{{ url("images/banner.png") }}" alt="">
                <h3>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi consequatur consequuntur delectus, dignissimos enim illo impedit labore laboriosam mollitia nemo non numquam quaerat quis, sequi sunt suscipit veniam vitae. Porro?
                </h3>
            </div>
        </div>

        <div class="services btn-margin pd">
            <div class="container">

                <input class="float-right" type="text" name="search" id="search" placeholder="Поиск по специализациям">

                <h1 class="title">
                    Специалисты
                </h1>
                <div class="tabs">
                    <div class="tab active" data-id="1">
                        Врачи
                    </div>
                    <div class="tab" data-id="2">
                        Юристы
                    </div>
                </div>
                <div class="tab-contents">
                    <div class="tab-content" data-id="1">
                        <div class="row row-pd no-gutters">
                            @foreach(\App\Models\Category::where("parent_id", 81)->orderBy("title")->get() as $item)
                                <div class="col-lg-3 col-pd" data-parent-id="{{ $item->parent_id }}">
                                    <div class="item">
                                        <div class="item-image">
                                            <a href="{{ url("experts", $item->id) }}">
                                                <img src="{{ url("images/uploads", $item->image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="item-title">
                                            <a href="{{ url("experts", $item->id) }}">{{ json_decode($item->title)->ru }}</a>
                                            <!--<p>Краткое описание</p>-->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-content" data-id="2">
                        <div class="row row-pd no-gutters">
                            @foreach(\App\Models\Category::where("parent_id", 82)->orderBy("title")->get() as $item)
                                <div class="col-lg-3 col-pd" data-parent-id="{{ $item->parent_id }}">
                                    <div class="item">
                                        <div class="item-image">
                                            <a href="{{ url("experts", $item->id) }}">
                                                <img src="{{ url("images/uploads", $item->image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="item-title">
                                            <a href="{{ url("experts", $item->id) }}">{{ json_decode($item->title)->ru }}</a>
                                            <!--<p>Краткое описание</p>-->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <p class="text-center">
                    <a href="" class="btn">Весь список</a>
                </p>
            </div>
        </div>

        <div class="info bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="info-image">
                            <img src="{{ url("images/info1.svg") }}" alt="">
                        </div>
                        <div class="info-title">
                            Компетентные врачи
                        </div>
                        <div class="info-description">
                            Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum non.
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info-image">
                            <img src="{{ url("images/info2.svg") }}" alt="">
                        </div>
                        <div class="info-title">
                            В любой момент
                        </div>
                        <div class="info-description">
                            Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum non.
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info-image">
                            <img src="{{ url("images/info3.svg") }}" alt="">
                        </div>
                        <div class="info-title">
                            Приватно
                        </div>
                        <div class="info-description">
                            Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum non.
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info-image">
                            <img src="{{ url("images/info4.svg") }}" alt="">
                        </div>
                        <div class="info-title">
                            С историей
                        </div>
                        <div class="info-description">
                            Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum non.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about">
            <div class="container">
                <div class="about-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Консультации в чате</h3>
                            <p>Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum</p>
                            <a href="" class="btn">Выбрать специалиста</a>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ url("images/about2x.png") }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="about-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{ url("images/about2x.png") }}" alt="">
                        </div>
                        <div class="col-lg-6">
                            <h3>Тщательный отбор специалистов</h3>
                            <p>Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum</p>
                            <a href="" class="btn">Выбрать специалиста</a>
                        </div>
                    </div>
                </div>

                <div class="about-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Круглосуточно</h3>
                            <p>Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum</p>
                            <a href="" class="btn">Выбрать специалиста</a>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ url("images/about2x.png") }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="about-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{ url("images/about2x.png") }}" alt="">
                        </div>
                        <div class="col-lg-6">
                            <h3>Приватно</h3>
                            <p>Lorem ipsum dolor sit amet consectetur. Tellus odio commodo vitae aliquam augue est bibendum</p>
                            <a href="" class="btn">Выбрать специалиста</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="jumbotron bg pd">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Lorem ipsum door sit amet</h3>
                        <p>Lorem ipsum dolor sit amet consectetur. Ut erat faucibus consectetur nibh mi ultricies. Nec aliquet leo massa maecenas purus quam eget in ac. Suspendisse a nibh mi consequat pellentesque. Nulla in mi libero arcu libero aliquam. Lorem facilisis diam sit leo cras. Aliquam a facilisi risus amet vitae. Risus nec a eu senectus pretium sed suspendisse dictum.</p>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ url("images/banner2x.png") }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="faq pd">
            <div class="container container-secondary">
                <h1 class="title">Частые вопросы</h1>
                <div class="faq-item">
                    <div class="faq-title">
                        Lorem ipsum dolor sit amet?
                    </div>
                    <div class="faq-description active">
                        Lorem ipsum dolor sit amet consectetur. Pellentesque ac sed felis tellus quam ut ornare et. Ultricies a enim consectetur augue placerat neque nunc integer rhoncus. Potenti elementum vitae neque nunc vel urna imperdiet tortor ullamcorper. Interdum morbi morbi praesent auctor turpis a suscipit.
                    </div>
                </div>
                <?php for($i=1; $i<=5; $i++) { ?>
                <div class="faq-item">
                    <div class="faq-title">
                        Lorem ipsum dolor sit amet?
                    </div>
                    <div class="faq-description">
                        Lorem ipsum dolor sit amet consectetur. Pellentesque ac sed felis tellus quam ut ornare et. Ultricies a enim consectetur augue placerat neque nunc integer rhoncus. Potenti elementum vitae neque nunc vel urna imperdiet tortor ullamcorper. Interdum morbi morbi praesent auctor turpis a suscipit.
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="reviews">
            <div class="container">
                <h1 class="title">Отзывы о сервисе</h1>
                <div class="owl-carousel owl-theme">
                    <?php for($i=1; $i<=10; $i++) { ?>
                    <div class="review">
                        <div class="review-content">
                            <div class="review-date">
                                14 апреля 2023 г.
                            </div>
                            <div class="review-rating">
                                <div class="rate">
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
                            <div class="review-data">
                                <p class="review-description">Lorem ipsum dolor sit amet consectetur. Pellentesque ac sed felis tellus quam ut ornare et. Ultricies a enim consectetur augue placerat neque nunc integer rhoncus. Potenti elementum vitae neque nunc vel urna imperdiet tortor ullamcorper. Interdum morbi morbi praesent auctor turpis a suscipit.</p>
                            </div>
                        </div>
                        <div class="review-ava">
                            <img src="{{ url("images/user.png") }}" alt="">
                            <span>Константин К.</span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="about bg">
            <div class="container">

                <div class="about-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{ url("images/about2x.png") }}" alt="">
                        </div>
                        <div class="col-lg-6">
                            <h3>Приложение для телефонов</h3>
                            <p>Lorem ipsum dolor sit amet consectetur. Phasellus risus dui mauris ipsum. Vestibulum mi lorem augue porttitor in at.</p>
                            <div class="inline-parent">
                                <div>
                                    <a href="">
                                        <img src="{{ url("images/google-play.svg") }}" alt="">
                                    </a>
                                </div>
                                <div>
                                    <a href="">
                                        <img src="{{ url("images/app-store.svg") }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

@endsection
