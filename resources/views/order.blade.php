@extends("app")

@section("content")

    <div class="pd">
        <div class="container container-small">
            <form method="POST" action="{{ url("order") }}">
                @csrf
                <div class="step step1 active">
                    <h1 class="title text-center">
                        Формат консультации
                    </h1>

                    <div class="order-tabs">
                        <div class="order-tab active">
                            <label for="format-1">
                                Видео звонок
                            </label>
                        </div>
                        <div class="order-tab">
                            <label for="format-2">
                                На дом
                            </label>
                        </div>
                        <div class="order-tab">
                            <label for="format-3">
                                В клинику
                            </label>
                        </div>
                    </div>

                    <input checked id="format-1" type="radio" name="format" value="1">
                    <input id="format-2" type="radio" name="format" value="2">
                    <input id="format-3" type="radio" name="format" value="3">

                    <input name="expert_id" type="hidden" value="{{ $unique_id }}">

                    <div class="form-group">

                        <p class="form-heading">Время</p>
                        <p class="form-subheading">Ежедневно с 8 до 24ч.</p>

                    </div>

                    <div class="form-group">
                        <label for="">День недели</label>
                        <input id="datepicker" name="date" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Время</label>
                        <input id="timepicker" name="time" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <p class="form-subheading">Время консультации: ~ 30 минут</p>
                        <p class="form-subheading">Подробный отчёт после консультации: рекомендуемые анализы, к кому обратиться дальше, что сделать сейчас, чтобы стало лучше</p>
                    </div>

                    <p class="text-center">
                        <a href="" class="btn">Далее</a>
                    </p>
                </div>

                <div class="step step2">
                    <h1 class="title text-center">
                        <img class="back-arrow" src="{{ url("images/arrow_back.png") }}" alt="">
                        Консультация врача <!-- Term -->
                    </h1>

                    <div class="form-group">
                        <div class="table-form">
                            <table class="table-form">
                                <tr>
                                    <td>Формат:</td>
                                    <td>Онлайн, ~30 мин</td>
                                </tr>
                                <tr>
                                    <td>Дата:</td>
                                    <td>Понедельник, 10/04</td>
                                </tr>
                                <tr>
                                    <td>Время:</td>
                                    <td>08:00 – 08:30</td>
                                </tr>
                                <tr>
                                    <td>Сумма:</td>
                                    <td> 50 000 сум</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <p class="text-center">
                        <input type="submit" class="btn" value="Записаться">
                    </p>

                </div>


            </form>

        </div>
    </div>

@endsection
