@isset($tags)
<div class="offset-top-60">
    <h6 class="font-weight-bold">Tags</h6>
    <div class="text-subline"></div>
    <div class="offset-top-20">
        <div class="tags-list group group-sm d-inline-block text-middle">
            @foreach($tags as $tag)
            <a class="btn btn-xs button-primary font-italic" href="{{ route('tag', $tag->slug) }}">{{ $tag->name ?? null }}</a>
            @endforeach
        </div>
    </div>
</div>
@endisset