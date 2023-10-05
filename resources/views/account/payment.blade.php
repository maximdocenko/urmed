@extends("app")

@section("content")

    <div class="pd btn-margin">
        <div class="container container-small">
            <form method="POST" action="{{ url("account/payment") }}">
                @csrf
                <div class="step step1 active">

                    <h1 class="title text-center">Пополнить баланс</h1>


                    <div class="payment-methods">
                        <div class="payment-method">
                            <input type="radio" name="payment-method" value="click" id="click">
                            <label for="click">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span></span>
                                        Click
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <img src="{{ url("images/click.svg") }}" alt="">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" name="payment-method" value="payme" id="payme">
                            <label for="payme">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span></span>
                                        Payme
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <img src="{{ url("images/payme.svg") }}" alt="">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <p class="text-center">
                        <a href="" class="btn">Далее</a>
                    </p>



                </div>

                <div class="step step2">
                    <h1 class="title text-center">
                        <img class="back-arrow" src="{{ url("images/arrow_back.png") }}" alt="">
                        Пополнить баланс
                    </h1>

                    <div class="form-group">
                        <label for="">Сумма пополнения</label>
                        <input name="amount" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Номер карты</label>
                        <input name="card" type="text" class="form-control">
                    </div>

                    <p class="text-center">
                        <a href="" class="btn">Продолжить</a>
                    </p>
                </div>

                <div class="step step3">
                    <h1 class="title text-center">
                        <img class="back-arrow" src="{{ url("images/arrow_back.png") }}" alt="">
                        Чек
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
                        <input type="submit" class="btn" value="Оплатить">
                    </p>

                </div>

            </form>

        </div>
    </div>

@endsection
