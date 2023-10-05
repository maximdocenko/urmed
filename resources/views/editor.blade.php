@extends("app")

@section("styles")
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section("scripts")
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        $(document).ready(function (){
            var simplemde = new SimpleMDE({ element: document.getElementById("simplemde") });
        });
    </script>
@endsection

@section("content")

    <div class="container pd">
        <textarea name="" id="simplemde" cols="30" rows="10">

        </textarea>
    </div>

@endsection
