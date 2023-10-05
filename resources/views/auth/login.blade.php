@extends('app')

@section('content')
    <div class="pd">
        <div class="container container-small">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="title text-center">
                    Вход
                </h1>

                <div class="form-group">
                    <label for="">Логин</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Пароль</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <p class="text-center">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </p>

                <p class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Вход
                    </button>
                </p>
                <p class="text-center">
                    @if (Route::has('password.request'))
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Забыли пароль?') }}
                        </a>
                   @endif
                </p>


            </form>

        </div>
    </div>
@endsection
