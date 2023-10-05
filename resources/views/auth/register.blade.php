@extends('app')

@section("scripts")

@endsection

@section('content')
    <div class="pd">
        <div class="container container-small">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="step step1 active">
                    <h1 class="title text-center">
                        Регистрация
                    </h1>

                    <input checked="checked" style="visibility: hidden; width: 1px; height: 1px" type="radio" name="role" value="user" id="role-user">
                    <input style="visibility: hidden; width: 1px; height: 1px" type="radio" name="role" value="doctor" id="role-doctor">
                    <input style="visibility: hidden; width: 1px; height: 1px" type="radio" name="role" value="lawyer" id="role-lawyer">

                    <div class="order-tabs">
                        <label for="role-user" class="order-tab active">Клиент Avi</label>
                        <label for="role-doctor" class="order-tab">Медицина</label>
                        <label for="role-lawyer" class="order-tab">Юриспруденция</label>
                    </div>

                    <div class="form-group">
                        <label for="">Ваше имя</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Телефон</label>
                        <input placeholder="(90) 123-45-67" id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Стоимость консультации (сум)</label>
                        <input type="number" class="form-control" name="price">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group form-group-additional" style="z-index: 1">
                                <label for="">Начало работы</label>
                                <select class="form-control" name="start_of_work_year" id="">
                                    <option value="">Год</option>
                                    @for($i = date("Y"); $i>=1950; $i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                @error('start_of_work_year')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group form-group-additional" style="z-index: 1">
                                <label for="">Начало работы</label>
                                <select class="form-control" name="start_of_work_month" id="">
                                    <option value="">Месяц</option>
                                    <option value="01">Январь</option>
                                    <option value="02">Февраль</option>
                                    <option value="03">Март</option>
                                    <option value="04">Апрель</option>
                                    <option value="05">Май</option>
                                    <option value="06">Июнь</option>
                                    <option value="07">Июль</option>
                                    <option value="08">Август</option>
                                    <option value="09">Сентябрь</option>
                                    <option value="10">Октябрь</option>
                                    <option value="11">Ноябрь</option>
                                    <option value="12">Декабрь</option>
                                </select>
                                @error('start_of_work_month')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Темы</label>
                        <div class="form-control-border">
                            @foreach(\App\Models\Category::whereIn("parent_id", [4,5,43,44])->orderBy("title")->get() as $item)
                                <label data-parent="{{ $item->parent_id }}" class="label-relative" for="category_{{ $item->id }}">
                                    <img class="label-image" src="{{ url("images/uploads", $item->image) }}" alt="">
                                    <input name="category_id[]" id="category_{{ $item->id }}" type="checkbox" data-parent="{{ $item->parent_id }}" value="{{ $item->id }}">
                                    {{ json_decode($item->title)->ru }}
                                </label>
                            @endforeach
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Направление</label>
                        <div class="form-control-border">
                           @foreach(\App\Models\Category::whereIn("parent_id", [81,82])->orderBy("title")->get() as $item)
                                <label data-parent="{{ $item->parent_id }}" class="label-relative" for="category_{{ $item->id }}">
                                    <img class="label-image" src="{{ url("images/uploads", $item->image) }}" alt="">
                                    <input name="category_id[]" id="category_{{ $item->id }}" type="checkbox" data-parent="{{ $item->parent_id }}" value="{{ $item->id }}">
                                    {{ json_decode($item->title)->ru }}
                                </label>
                           @endforeach
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Квалификация</label>
                        <textarea class="form-control" name="qualification"></textarea>
                        @error('qualification')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Образование</label>
                        <textarea class="form-control" name="education"></textarea>
                        @error('education')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Курсы повышения квалификации (не обязательно)</label>
                        <textarea class="form-control" name="training"></textarea>
                        @error('training')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Место работы</label>
                        <textarea class="form-control" name="place_of_work"></textarea>
                        @error('place_of_work')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-group-additional">
                        <label for="">Адрес</label>
                        <textarea class="form-control" name="address"></textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Пароль</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Повторите пароль</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <p class="text-center">
                        <button type="submit" class="btn">
                            Регистрация
                        </button>
                    </p>

                </div>
            </form>
        </div>
    </div>


@endsection
