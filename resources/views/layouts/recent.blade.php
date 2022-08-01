@isset($recents)
<div class="offset-top-60">
    <!--Recent posts-->
    <h6 class="font-weight-bold">Recent News</h6>
    <div class="text-subline"></div>
    <div class="text-left">
        @foreach($recents as $recent)
        <div class="offset-top-20">
            <article class="widget-post">
                <h6 class="font-weight-bold text-primary"><a href="{{ route('detail-news', $recent->slug) }}">{{ $recent->name ?? null }}</a></h6>
                <p class="text-dark">{{ $recent->created_at->diffForHumans() ?? null }} by {{ $recent->author->name ?? null }}</p>
            </article>
        </div>
        @endforeach
    </div>
</div>
@endisset