@extends("app")
@section("content")

    <div class="pd">
        <div class="container">
            <div class="chat-container">
                <div class="row">
                    <div class="col-4">
                        <div class="chat-sidebar">
                            <div class="chat-search-wrapper">
                                <input type="text" class="chat-search" placeholder="Поиск">
                            </div>
                            <div class="chat-item">
                                @foreach($users as $user)
                                    <a href="{{ url("chat", $user->unique_id) }}">
                                        @if($user->image)
                                            <img class="user-avatar" src="{{ url("images/users") }}/{{$user->image}}" alt="">
                                        @endif
                                        {{ $user->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="tg" style="padding-right: 15px">
                            <div id="chat-loader">

                            </div>
                            <div id="chat-fields">
                                <textarea class="form-control" name="" id="message"></textarea>
                                <button onclick="return chat_validation()" id="send">
                                    <img src="{{ url("assets/images/tg.png") }}" alt="">
                                </button>
                            </div>
                            <script type="text/javascript">
                                function chat_validation(){

                                    const textmsg = $('#message').val();
                                    //const receive = $('#receive').val();
                                    //const send    = $('#send').val();

                                    if(textmsg == ""){
                                        alert('Type Message....');
                                        return false;
                                    }
                                    const datastr = 'message='+textmsg+'&unique_id={{$unique_id}}';
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
                                            $('#chat-loader').html(e);
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
                                        data:'unique_id={{$unique_id}}',
                                        url:'{{url("messages")}}',
                                        success:function(e){
                                            $('#chat-loader').html(e);
                                        }
                                    });
                                }, 100);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
