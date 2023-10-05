@extends("video")
@section("styles")
    <link rel="stylesheet" href="{{url('css/index.css')}}">
    <link rel="stylesheet" href="{{url('css/agora.css')}}">
@endsection
@section("content")
    <div class="navbar-area">
        <div class="container-fluid">
            <a target="_blank" class="Header-link " href="{{url('/')}}">
                <img class="main-logo" src="{{url('assets/images/logo.png')}}" alt="">
            </a>
        </div>
    </div>


    <div class="container">

        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulations!</strong><span> You can invite others join this channel by click </span><a href="" target="_blank">here</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="success-alert-with-token" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulations!</strong><span> Joined room successfully. </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="success-alert-with-token" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulations!</strong><span> Joined room successfully. </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form id="join-form">

                <!--<div class="col-sm">
                    <input id="appid" value="d88b2a459fb54b9c871f37ca55b5bea5" type="hidden" placeholder="enter appid" required>
                </div>
                <div class="col-sm">
                    <input id="token" value="{{ $data->token ?? '' }}" type="hidden" placeholder="enter token">
                </div>-->
                <div class="chat-form">
                    <div class="form-group">
                        <label for="">Канал</label>
                        <input class="form-control" id="channel" value="{{ $data->channel ?? '' }}" type="text" placeholder="enter channel name" required>
                    </div>
                </div>


            <div class="button-group text-center">
                <button id="join" type="submit" class="btn btn-primary btn-sm">Подключиться</button>
                <button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Покинуть видеочат</button>
            </div>
        </form>

        <div class="video-group">
            <div id="remote-playerlist" class="row">
                <div class="col-lg-6">
                    <!--<p id="local-player-name" class="player-name"></p>-->
                    <div id="local-player" class="player"></div>
                </div>
            </div>
        </div>
    </div>

    @include("partials.chat")

    <script src="{{url('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('js/AgoraRTC_N-4.16.0.js')}}"></script>
    <script type="text/javascript" src="{{url('js/scripts.js')}}"></script>
@endsection
