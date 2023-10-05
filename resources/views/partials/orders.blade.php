<div class="orders pd">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-4">
                @if(count($orders))
                    @foreach($orders as $item)
                        <div class="order-item">
                            <div class="user report-user">
                                <div class="user-ava">
                                    <a href="{{ url("expert") }}">
                                        @if($item->expert->photo)
                                            <img src="{{ url("images/ava", $item->expert->photo) }}" alt="">
                                        @else
                                            <img src="{{ url("images/default.svg") }}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="user-content">
                                    <a class="profile-link" href="{{ url("account/orders", $item->id) }}">
                                        Просмотр
                                    </a>
                                    <div class="user-title">
                                        <a href="{{ url("expert") }}">
                                            {{ $item->expert['name'] ?? '' }}
                                        </a>
                                    </div>
                                    <div class="user-data">
                                        <p class="user-description">
                                            @if($item->format == 1)
                                                Видео звонок
                                            @endif
                                            @if($item->format == 2)
                                                На дом
                                            @endif
                                            @if($item->format == 3)
                                                В клинику
                                            @endif
                                        </p>
                                        <p class="user-description">
                                            {{ $item->date }} в {{ $item->time }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if(!$item->channel)
                                @if(in_array(auth()->user()->role, ['doctor', 'lawyer']))
                                <form class="text-center" method="POST" action="{{ url("token") }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="hidden" name="expert_id" value="{{ $item->expert['id'] ?? 0 }}">
                                    <input type="hidden" name="user_id" value="{{ $item->user['id'] ?? 0 }}">
                                    <input type="submit" href="{{ url("agora") }}" value="Создать звонок" class="btn">
                                </form>
                                @endif
                            @else
                                <p class="text-center">
                                    <a class="btn" href="{{ url("agora") }}?channel={{$item->channel}}">
                                        Начать общение
                                    </a>
                                </p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <h1 class="title text-center">
                        Пока нет заявок
                    </h1>
                @endif
            </div>
        </div>
    </div>
</div>
