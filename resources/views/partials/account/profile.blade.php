<div class="profile {{ $class }}">
    <a href="{{ url("account") }}">
        <span>
            @if(!auth()->user()->photo)
                <img src="{{ url("images/default.svg") }}" alt="">
            @else
                <img src="{{ url("images/ava", auth()->user()->photo) }}" alt="">
            @endif

        </span>
        <div>
            <?= mb_substr(auth()->user()->name, 0, 20); ?><br/>
            @if(auth()->user()->role == 'user')
                <span>Баланс: {{ auth()->user()->balance }} сум</span>
            @endif
        </div>
    </a>
    @if($menu)
        <ul class="profile-nav">
            <li>
                Ваш баланс<br/>
                <a href="" class="link">{{ auth()->user()->balance }} сум</a>
            </li>
            @if(auth()->user()->role == 'user')
            <li><a href="{{ url('account/payment') }}">Пополнить баланс</a></li>
            @endif
            <li><a href="{{ url("account/orders") }}">Консультации</a></li>
            <li>
                <form id="logout-form" action="{{ route("logout") }}" method="POST">
                    @csrf
                </form>
                <a onclick="document.getElementById('logout-form').submit()">Выход</a>
            </li>
        </ul>
    @endif
</div>
