<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/x-icon" href="{{ url("images/favicon.ico") }}">

    <link rel="stylesheet" href="{{ url("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ url("css/style.css") }}">
    <link rel="stylesheet" href="{{ url("css/content.css") }}">
    <link rel="stylesheet" href="{{ url("css/lang.css") }}">
    <link rel="stylesheet" href="{{ url("css/logo.css") }}">
    <link rel="stylesheet" href="{{ url("css/account.css") }}">
    <link rel="stylesheet" href="{{ url("css/about.css") }}">
    <link rel="stylesheet" href="{{ url("css/info.css") }}">
    <link rel="stylesheet" href="{{ url("css/form.css") }}">
    <link rel="stylesheet" href="{{ url("css/check.css") }}">
    <link rel="stylesheet" href="{{ url("css/inline-block.css") }}">
    <link rel="stylesheet" href="{{ url("css/jumbotron.css") }}">
    <link rel="stylesheet" href="{{ url("css/owl.css") }}">
    <link rel="stylesheet" href="{{ url("css/faq.css") }}">
    <link rel="stylesheet" href="{{ url("css/reviews.css") }}">
    <link rel="stylesheet" href="{{ url("css/custom-search.css") }}">
    <link rel="stylesheet" href="{{ url("css/alerts.css") }}">
    <link rel="stylesheet" href="{{ url("css/chat.css") }}">
    <link rel="stylesheet" href="{{ url("css/footer.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">


    @yield("styles")

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript" src="{{ url("js/jquery.mask.js") }}"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#phone').mask('(00) 000-00-00');
            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function (){
            $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
            });
/*
            $( "#timepicker" ).datetimepicker({
                format: 'HH:mm'
            });

 */
        });
    </script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 60,
                minTime: '9',
                maxTime: '6:00pm',
                //defaultTime: '11',
                //startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });

    </script>

    <!--
        <script src='https://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js'></script>

        <script type="text/javascript">
            $(document).ready(function (){
                $('.topics-row').mixItUp({

                    selectors: {
                        target: '.topic-item',
                        filter: '.topic-filter',
                        sort: '.sort-btn'
                    },

                    animation: {
                        animateResizeContainer: false,
                        effects: 'fade scale'
                    }

                });
            });
        </script>
    -->
    @yield("scripts")

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function (){


            $('.reviews .owl-carousel').owlCarousel({
                loop:true,
                margin:31,
                nav:true,
                navText : ["<img src='{{ url("images/left_arrow.png") }}'/>","<img src='{{ url("images/right_arrow.png") }}'/>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            })

            $('.topics .owl-carousel').owlCarousel({
                loop:true,
                margin:31,
                nav:true,
                navText : ["<img src='{{ url("images/left_arrow.png") }}'/>","<img src='{{ url("images/right_arrow.png") }}'/>"],
                responsive:{
                    0:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:6
                    }
                }
            })


            $(".tabs .tab").click(function (){
                el = $(this);
                el.parents(".container").find(".tab").removeClass("active");
                el.addClass("active");
                id = el.data("id");
                el.parents(".container").find(".tab-content").hide();
                el.parents(".container").find(".tab-content[data-id="+id+"]").show();
                el.parents(".container").find("#search").val("").keyup();
            });

            $(".buttons .button").click(function (){
                el = $(this);
                el.parents(".buttons").find(".button").removeClass("active");
                el.addClass("active");
                id = el.data("id");
                el.parents(".tab-content").find(".col-pd").hide();
                el.parents(".tab-content").find(".col-pd[data-parent-id="+id+"]").show();
            });

            $(".order-tabs .order-tab").click(function (){
                el = $(this);
                $(".order-tabs .order-tab").removeClass("active");
                el.addClass("active");
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

            $(".step .back-arrow").click(function (){
                el = $(this);
                current = el.parents(".step:first");
                prev = current.prev(".step");
                if(prev.length) {
                    current.removeClass("active");
                    prev.addClass("active");
                    return false;
                }
            });

            $("input[name=role]").change(function (){
                el = $(this);
                $(".form-group-additional input[type=checkbox]").removeAttr("checked")
                if(el.val() == 'user') {
                    $(".form-group-additional").hide();
                    $(".form-group-additional .label-relative").removeClass("active");
                }
                if(el.attr("id") == 'role-doctor') {
                    $(".form-group-additional").show();
                    $(".form-group-additional .label-relative").removeClass("active");
                    $(".form-group-additional .label-relative[data-parent=81]").addClass("active");
                    $(".form-group-additional .label-relative[data-parent=4]").addClass("active");
                    $(".form-group-additional .label-relative[data-parent=5]").addClass("active");
                }
                if(el.attr("id") == 'role-lawyer') {
                    $(".form-group-additional").show();
                    $(".form-group-additional .label-relative").removeClass("active");
                    $(".form-group-additional .label-relative[data-parent=82]").addClass("active");
                    $(".form-group-additional .label-relative[data-parent=43]").addClass("active");
                    $(".form-group-additional .label-relative[data-parent=44]").addClass("active");
                }
            });

            $(".faq-title").click(function (){
                el = $(this);
                el.toggleClass("active");
                el.next(".faq-description").toggleClass("active");
            });

            $(".tab, .button").each(function (){
                el = $(this);
                if(el.hasClass("active")) {
                    el.click();
                }
            });

            $("#search").keyup(function (){
                el = $(this);
                var txt = el.val();
                el.parents(".container:first").find('.col-pd').each(function(){
                    if($(this).text().toUpperCase().indexOf(txt.toUpperCase()) != -1){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            });

        });
    </script>

    <title>Document</title>
</head>
<body>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="logo">
                    <a href="{{ url("/") }}">
                        <img src="{{ url("images/logo.svg") }}" alt="">
                    </a>
                </div>
                @include("partials.lang")
            </div>
            <div class="col-lg-4">
                <div id="menu">
                    <ul>
                        <li class="{{ request()->url() == url("account/orders") ? 'active' : null }}">
                            <a href="">Консультации</a>
                        </li>
                        <li class="{{ str_contains(request()->url(), "agora") ? 'active' : null }}">
                            <a href="{{ url("agora") }}">Видео чат</a>
                        </li>
                    </ul>
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
    <div class="container">
        <div class="row" style="align-items: center">
            <div class="col-lg-4">
                <div class="logo">
                    <a href="{{ url("/") }}">
                        <img src="{{ url("images/logo.svg") }}" alt="">
                    </a>
                </div>
                @include("partials.lang")
            </div>
            <div class="col-lg-8">
                <div class="footer-menu">
                    <ul>
                        <li>
                            <a href="{{ url("about") }}">О нас</a>
                        </li>
                        <li>
                            <a href="{{ url("privacy-policy") }}">Политика конфиденциальности</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <p>© AVI — 2023</p>
</div>

</body>
</html>
