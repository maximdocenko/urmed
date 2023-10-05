<div class="topics btn-margin pd">
    <div class="container">
        <h1 class="title">
            Темы
        </h1>
        <div class="tabs">
            @foreach(\App\Models\Topic::where("parent_id", 0)->get() as $parent)

                <div class="tab" data-id="{{ $parent->id }}">
                    {{ json_decode($parent->title)->ru }}
                </div>

                <div class="tab-contents">
                    <div class="tab-content" data-id="1">
                        <div class="buttons">

                            @foreach(\App\Models\Topic::where("parent_id", $parent->id)->get() as $top)
                                <div class="button" data-id="{{ $top->id }}">
                                    {{ json_decode($top->title)->ru }}
                                </div>
                                <div class="row row-pd no-gutters">
                                    @foreach(\App\Models\Topic::where("parent_id", $top->id)->get() as $topic)
                                        <div class="col-lg-2 col-pd" data-parent-id="{{ $topic->parent_id }}">
                                            <div class="item">
                                                <div class="item-image">
                                                    <a href="">
                                                        <img src="{{ url("images/uploads", $topic->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="item-title">
                                                    <a href="">
                                                        {{ json_decode($topic->title)->ru }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
