@extends("app")

@section("content")

    <div class="pd">
        <div class="container container-small">
            <h1 class="title text-center">Информация</h1>
            <form action="">

                <div class="form-group form-group-ava">
                    <div class="ava">
                        <img src="{{ url("images/default.svg") }}" alt="">
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
                            <input type="file" name="image">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Ваше ФИО</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Ваша специализация</label>
                    <select class="form-control">
                        <option value="">Выбрать</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Квалификация</label>
                    <textarea class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Образование</label>
                    <textarea class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="">Повышение квалификации</label>
                    <textarea class="form-control"></textarea>
                </div>

                <p class="text-center">
                    <a href="" class="btn">Сохранить</a>
                </p>

            </form>

        </div>
    </div>

@endsection
