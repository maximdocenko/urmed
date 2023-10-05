@extends("app")

@section("content")

    <div class="pd">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @if($cuser->role == 'user')
                        <div class="profile">

                            <ul class="profile-menu">
                                <li><a href="{{ url('account/payment') }}">Пополнить баланс</a></li>
                                <li><a href="{{ url("account/orders") }}">Консультации</a></li>
                                <li><a href="{{ url("account/report") }}">report</a></li>
                                <li><a href="{{ url("account/feedback") }}">feedback</a></li>
                            </ul>

                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <h1 class="title text-center">Профиль</h1>

                    @if(session()->get("success"))
                        <div class="alert alert-success">
                            {{ session()->get("success") }}
                        </div>
                    @endif

                    <form enctype="multipart/form-data" method="POST" action="{{ url('account/update') }}">
                        @csrf
                        @method("PUT")

                        <div class="form-group form-group-ava">
                            <div class="ava">
                                @if(!$cuser->photo)
                                    <img src="{{ url("images/default.svg") }}" alt="">
                                @else
                                    <img src="{{ url("images/ava", $cuser->photo) }}" alt="">
                                @endif
                            </div>
                            <div class="profile-file">
                                <div class="beautiful-file">
                                    <span>
                                        <img src="{{ url("images/select-file.svg") }}" alt="">
                                        Выбрать фото
                                    </span>
                                    <input type="file" name="image">
                                </div>
                                <div class="beautiful-file">
                                    <span>
                                        <img src="{{ url("images/delete-file.svg") }}" alt="">
                                        Удалить
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Ваше имя</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $cuser->name }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Телефон</label>
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $cuser->phone }}" required autocomplete="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $cuser->email }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @if($role != 'user')

                            <div class="form-group">
                                <label for="">Стоимость консультации (сум)</label>
                                <input value="{{ $cuser->price }}" type="number" class="form-control" name="price">
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group" style="z-index: 1">
                                        <label for="">Начало работы</label>
                                        <select class="form-control" name="start_of_work_year" id="">
                                            <option value="">Год</option>
                                            @for($i = date("Y"); $i>=1950; $i--)
                                                <option {{ meta($cuser->meta, 'start_of_work_year') == $i ? 'selected' : null }} value="{{$i}}">{{$i}}</option>
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
                                    <div class="form-group" style="z-index: 1">
                                        <label for="">Начало работы</label>
                                        <select class="form-control" name="start_of_work_month" id="">
                                            <option value="">Месяц</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '01' ? 'selected' : null }} value="01">Январь</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '02' ? 'selected' : null }} value="02">Февраль</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '03' ? 'selected' : null }} value="03">Март</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '04' ? 'selected' : null }} value="04">Апрель</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '05' ? 'selected' : null }} value="05">Май</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '06' ? 'selected' : null }} value="06">Июнь</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '07' ? 'selected' : null }} value="07">Июль</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '08' ? 'selected' : null }} value="08">Август</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '09' ? 'selected' : null }} value="09">Сентябрь</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '10' ? 'selected' : null }} value="10">Октябрь</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '11' ? 'selected' : null }} value="11">Ноябрь</option>
                                            <option {{ meta($cuser->meta, 'start_of_work_month') == '12' ? 'selected' : null }} value="12">Декабрь</option>
                                        </select>
                                        @error('start_of_work_month')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Направление</label>
                                <div class="form-control-border">
                                    @if($cuser->role == 'doctor')
                                        @foreach(\App\Models\Category::whereIn("parent_id", [81])->orderBy("title")->get() as $item)
                                            <label data-parent="{{ $item->parent_id }}" class="label-relative active" for="category_{{ $item->id }}">
                                                <img class="label-image" src="{{ url("images/uploads", $item->image) }}" alt="">
                                                <input {{ in_array($item->id, $cuser->categories->pluck("category_id")->toArray()) ? 'checked' : null }} name="category_id[]" id="category_{{ $item->id }}" type="checkbox" data-parent="{{ $item->parent_id }}" value="{{ $item->id }}">
                                                {{ json_decode($item->title)->ru }}
                                            </label>
                                        @endforeach
                                    @endif
                                    @if($cuser->role == 'lawyer')
                                        @foreach(\App\Models\Category::whereIn("parent_id", [82])->orderBy("title")->get() as $item)
                                            <label data-parent="{{ $item->parent_id }}" class="label-relative active" for="category_{{ $item->id }}">
                                                <img class="label-image" src="{{ url("images/uploads", $item->image) }}" alt="">
                                                <input {{ in_array($item->id, $cuser->categories->pluck("category_id")->toArray()) ? 'checked' : null }} name="category_id[]" id="category_{{ $item->id }}" type="checkbox" data-parent="{{ $item->parent_id }}" value="{{ $item->id }}">
                                                {{ json_decode($item->title)->ru }}
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Темы</label>
                                <div class="form-control-border">
                                    @if($cuser->role == 'doctor')
                                        @foreach(\App\Models\Category::whereIn("parent_id", [4,5])->orderBy("title")->get() as $item)
                                            <label data-parent="{{ $item->parent_id }}" class="label-relative active" for="category_{{ $item->id }}">
                                                <img class="label-image" src="{{ url("images/uploads", $item->image) }}" alt="">
                                                <input {{ in_array($item->id, $cuser->categories->pluck("category_id")->toArray()) ? 'checked' : null }} name="category_id[]" id="category_{{ $item->id }}" type="checkbox" data-parent="{{ $item->parent_id }}" value="{{ $item->id }}">
                                                {{ json_decode($item->title)->ru }}
                                            </label>
                                        @endforeach
                                    @endif

                                    @if($cuser->role == 'lawyer')
                                        @foreach(\App\Models\Category::whereIn("parent_id", [43,44])->orderBy("title")->get() as $item)
                                            <label data-parent="{{ $item->parent_id }}" class="label-relative active" for="category_{{ $item->id }}">
                                                <img class="label-image" src="{{ url("images/uploads", $item->image) }}" alt="">
                                                <input {{ in_array($item->id, $cuser->categories->pluck("category_id")->toArray()) ? 'checked' : null }} name="category_id[]" id="category_{{ $item->id }}" type="checkbox" data-parent="{{ $item->parent_id }}" value="{{ $item->id }}">
                                                {{ json_decode($item->title)->ru }}
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Квалификация</label>
                                <textarea class="form-control" name="qualification">{{ meta($cuser->meta, 'qualification') }}</textarea>
                                @error('qualification')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Образование</label>
                                <textarea class="form-control" name="education">{{ meta($cuser->meta, 'education') }}</textarea>
                                @error('education')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Курсы повышения квалификации (не обязательно)</label>
                                <textarea class="form-control" name="training">{{ meta($cuser->meta, 'training') }}</textarea>
                                @error('training')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Место работы</label>
                                <textarea class="form-control" name="place_of_work">{{ meta($cuser->meta, 'place_of_work') }}</textarea>
                                @error('place_of_work')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                        @endif

                        <div class="form-group">
                            <label for="">Адрес</label>
                            <textarea class="form-control" name="address">{{ meta($cuser->meta, 'address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <p class="text-center">
                            <input type="submit" value="Сохранить" class="btn">
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
