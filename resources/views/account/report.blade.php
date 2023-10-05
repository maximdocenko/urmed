@extends("app")

@section("content")

    <div class="pd">
        <div class="container container-secondary">
            <div class="report-details">
                <h3>Консультация #{{$data->id}}</h3>
                <span>{{ $data->date }} в {{ $data->time }}</span>
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
                                    {{ meta($data->expert->meta, 'place_of_work') ?? '' }}<br/>
                                    Консультация: {{ $data->expert->price ?? 0 }} сум
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="textblock">
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab atque eligendi esse, excepturi exercitationem fuga iusto minima mollitia, nam optio quaerat quam quas repellendus sint soluta veniam voluptas voluptates.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if(isset($data->call->messages))
        <!-- Start Contact Area -->
        <div class="chat pd">
            <div class="container">
                <h1 class="title text-center color-white">Чат</h1>

                <div class="chat-form">

                    <div id="messages">
                        <div id="chat-loader">

                        </div>
                        <!--
                <div class="message">
                    <div class="chat-user">
                        <img class="chat-ava" src="{{ url("images/user.png") }}" alt="">
                        <div class="chat-info">
                            <div class="chat-name">Константинопольский Константин Константинович</div>
                            <div class="chat-service">Терапевт</div>
                        </div>
                    </div>
                    <div class="chat-text">
                        Lorem ipsum dolor sit amet consectetur
                    </div>
                </div>
                <div class="message current">
                    <div class="chat-text">
                        Lorem ipsum dolor sit amet consectetur
                    </div>
                </div>
                <div class="message current">
                    <div class="chat-text">
                        Lorem ipsum dolor sit amet consectetur
                    </div>
                </div>
                <div class="message current">
                    <div class="chat-text">
                        Lorem ipsum dolor sit amet consectetur
                    </div>
                </div>
                <div class="message">
                    <div class="chat-user">
                        <img class="chat-ava" src="{{ url("images/user.png") }}" alt="">
                        <div class="chat-info">
                            <div class="chat-name">Константинопольский Константин Константинович</div>
                            <div class="chat-service">Терапевт</div>
                        </div>
                    </div>
                    <div class="chat-text">
                        Lorem ipsum dolor sit amet consectetur
                    </div>
                </div>-->
                    </div>

                    <form id="contactForm">

                        <div class="form-group">
                            <label>Сообщение</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="6" required data-error="Write your message" placeholder="Напишите что-нибудь"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group text-center">
                            <button onclick="return chat_validation()" class="btn">
                                Отправить
                            </button>
                        </div>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>

                    </form>
                </div>
            </div>
        </div>
        <!-- End Contact Area -->

        <div class="pd">
            <div class="container">
                <div class="chat-container">
                    <div class="row">

                        <div class="col-8">
                            <div class="tg" style="padding-right: 15px">

                                <script type="text/javascript">
                                    function chat_validation(){

                                        const textmsg = $('#message').val();
                                        //const receive = $('#receive').val();
                                        //const send    = $('#send').val();

                                        if(textmsg == ""){
                                            alert('Type Message....');
                                            return false;
                                        }

                                        const datastr = 'message='+textmsg+'&room={{$data->call->channel}}';

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': '{{csrf_token()}}'
                                            }
                                        });
                                        $.ajax({
                                            url:'{{ url("message") }}',
                                            type:'POST',
                                            data:datastr,
                                            success:function(e){
                                                //$('#chat-loader').html(e);
                                                $('#message').val("");
                                            }
                                        });

                                        return false;
                                    }

                                    setInterval(function(){
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': '{{csrf_token()}}'
                                            }
                                        });
                                        $.ajax({
                                            type:'POST',
                                            data:'room={{$data->call->channel}}',
                                            url:'{{url("messages")}}',
                                            success:function(e){
                                                $('#chat-loader').html(e);
                                            }
                                        });
                                    }, 1000);
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif


@endsection
