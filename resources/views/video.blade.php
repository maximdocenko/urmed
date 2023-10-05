<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ url("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ url("css/style.css") }}">
    <link rel="stylesheet" href="{{ url("css/lang.css") }}">
    <link rel="stylesheet" href="{{ url("css/logo.css") }}">
    <link rel="stylesheet" href="{{ url("css/account.css") }}">
    <link rel="stylesheet" href="{{ url("css/form.css") }}">
    <link rel="stylesheet" href="{{ url("css/alerts.css") }}">
    <link rel="stylesheet" href="{{ url("css/chat.css") }}">
    <link rel="stylesheet" href="{{ url("css/footer.css") }}">

    @yield("styles")

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function (){

            $(".tabs .tab").click(function (){
                el = $(this);
                $(".tabs .tab").removeClass("active");
                el.addClass("active");
                id = el.data("id");
                el.parents(".container").find(".tab-content").hide();
                el.parents(".container").find(".tab-content[data-id="+id+"]").show();
            });

            $(".buttons .button").click(function (){
                el = $(this);
                $(".buttons .button").removeClass("active");
                el.addClass("active");
                id = el.data("id");
                el.parents(".container").find(".col-pd").hide();
                el.parents(".container").find(".col-pd[data-parent-id="+id+"]").show();
            });

            $(".step .btn").click(function (){
                el = $(this);
                current = el.parents(".step:first");
                next = current.next(".step");
                if(next.length) {
                    current.removeClass("active");
                    next.addClass("active");
                    return false;
                }
            });

        });
    </script>

    <title>Document</title>
</head>
<body>

<div class="header header-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="logo">
                    <a href="{{ url("/") }}">
                        <img src="{{ url("images/logo-video.svg") }}" alt="">
                    </a>
                </div>

            </div>

            <div class="col-lg-4">
                <div id="time">
                    <div class="counter">
                        <span class='e-m-hours'>0</span> Часов |
                        <span class='e-m-minutes'>0</span> Минут |
                        <span class='e-m-seconds'>0</span> Секунд
                    </div>
                </div>
            </div>

            <div class="col-lg-4 text-right">
                @if(!auth()->check())
                    <div id="nav">
                        <ul>
                            <li><a href="{{ url("login") }}">Войти</a></li>
                            <li><a href="{{ url("register") }}">Зарегистрироваться</a></li>
                        </ul>
                    </div>
                @else
                    @include("partials.account.profile", ['class' => 'text-right', 'menu' => 1])
                @endif
            </div>
        </div>
    </div>
</div>

@yield("content")

<div class="footer">

</div>

</body>
</html>
