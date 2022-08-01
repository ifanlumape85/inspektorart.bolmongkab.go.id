@isset($categories)
<div class="offset-top-60">
    <!-- Categories-->
    <h6 class="font-weight-bold">Categories</h6>
    <div class="text-subline"></div>
    <div class="offset-top-20">
        <ul class="list list-marked list-marked-primary">
            @foreach($categories as $category)
            <li><a href="{{ route('category', $category->slug) }}">{{ $category->name ?? null }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endisset