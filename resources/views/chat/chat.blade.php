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
                        <div class="tg">
                            <div class="tg-icon">
                                <img src="{{ url("assets/images/tg.png") }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
