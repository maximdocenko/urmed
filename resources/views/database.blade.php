@extends("app")

@section("content")

    <div class="container">

        <div class="row">
            <div class="col-lg-4">
                <h3 class="title">Sessions</h3>
                <table class="table">
                    <tr>
                        <td>id</td>
                        <td>user_id</td>
                        <td>client_id</td>
                        <td>chanel</td>
                        <td>token</td>
                        <td>time</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4">
                <h3 class="title">Balance</h3>
                <table class="table">
                    <tr>
                        <td>id</td>
                        <td>user_id</td>
                        <td>sum</td>
                        <td>type</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

@endsection
