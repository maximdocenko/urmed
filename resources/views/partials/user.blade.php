<div class="col-lg-4 col-pd">
    <div class="user">
        <div class="user-ava">
            <a href="{{ url("expert") }}">
                @if($item->photo)
                    <img src="{{ url("images/ava", $item->photo) }}" alt="">
                @else
                    <img src="{{ url("images/default.svg") }}" alt="">
                @endif
            </a>
        </div>
        @php
            $rate = 0;
            foreach($item->rating as $rating) {
                $rate += $rating->rate;
            }
        @endphp
        <div class="user-content">
            <div class="user-title">
                <a href="{{ url("expert", $item->unique_id) }}">{{ $item->name }}</a>
            </div>
            <div class="user-rating">
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text"></label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text"></label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text"></label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text"></label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text"></label>
                </div>
                @if(count($item->rating))
                    <span>{{floatval($rate / count($item->rating))}}</span>
                @else
                    <span>0</span>
                @endif
            </div>
            <div class="user-data">
                <p class="user-description">Стаж 14 лет</p>
                @include("partials.services", ['item' => $item])
                <p class="user-description">
                    Клиника «MedOsmotr»
                    Консультация: 50 000 сум
                </p>
            </div>
        </div>
    </div>
</div>
