@isset($banner)
<div class="offset-top-60 text-center">
    <a class="d-block" href="{{ $banner->link }}">
        <img class="img-responsive d-inline-block" src="{{ Storage::url($banner->image ?? null) }}" width="340" height="500" alt="">
    </a>
</div>
@endisset