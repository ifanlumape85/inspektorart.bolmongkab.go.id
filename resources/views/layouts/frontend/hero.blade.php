<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators"></ol>
    <div class="carousel-inner"></div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section id="welcome mt-4">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                @if(Storage::disk('public')->exists($profile->profile_picture ?? null))
                <img src="{{ Storage::url($profile->profile_picture ?? null) }}" alt="" class="mb-4 img-thumbnail image" style="object-fit:cover; object-position:center; width:400px;">
                @endif
                {!! $profile->welcome_speech ?? null !!}
                <p class="mt-2 font-weight-bolder">{{ $profile->departemen_head ?? null }}</p>
            </div>
        </div>
    </div>
</section>