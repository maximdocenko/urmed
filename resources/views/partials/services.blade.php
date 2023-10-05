<p class="user-description">
@php
    if($item->categories){
        foreach($item->categories as $category) {
            echo "  <span class='dot'>•</span>  " . json_decode($category->category['title'])->ru;
        }
    }
@endphp
</p>
