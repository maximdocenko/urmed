<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        img {
            max-width: 100%;
        }
        .ava {
            width: 80px;
            height: 80px;
            object-fit: 'cover';
            border-radius: 100%;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <ul>
                    <li>
                        <a href="{{ url('admin/users') }}">Пользователи</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/experts') }}">Эксперты</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/topics') }}">Темы</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/services') }}">Услуги</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/categories') }}">Категории</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-10">
                @yield("content")
            </div>
        </div>
    </div>

</body>
</html>