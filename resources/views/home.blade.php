@extends('layouts.frontend.app')
@push('addon-script')
<script src="/template/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(function() {
        slide();
        infografis();
    });

    function slide() {

        $.ajax({
            url: 'https://bolmongkab.go.id/api/slider',
            type: "GET",
            dataType: "json",
            success: function(response) {
                $('.carousel-indicators').html("");
                $('.carousel-inner').html("");
                if (response.response.status == 200) {

                    $.each(response.data.data, function(index, value) {
                        var classActive;
                        index == 0 ? classActive = 'active' : classActive = '';
                        $('.carousel-indicators').append(`<li data-target="#carouselExampleIndicators" data-slide-to="${index}" class="${classActive}"></li>`);
                        $('.carousel-inner').append(`<div class="carousel-item ${classActive}"><img class="d-block w-100" src="${value.image}" alt="" style="height:600px; object-fit:cover; object-position:center;"></div>`);
                    });
                }
            }
        });
    }

    function infografis() {
        $.ajax({
            url: 'https://bolmongkab.go.id/api/infografis',
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data.success == true) {
                    // alert('ok');
                }
            }
        });
    }
</script>
@endpush
@section('content')
<section id="blog" class="blog">
    <div class="container">

        <div class="section-title">
            <h2>News</h2>
        </div>

        <div class="row">
            <div class="col">
                <div class="row">
                    @foreach($news as $item)
                    <div class="col-12 d-flex align-items-stretch" data-aos="fade-up">
                        <article class="entry">
                            @if(Storage::disk('public')->exists($item->image ?? null))
                            <div class="entry-img">
                                <img src="{{ Storage::url($item->image ?? null) }}" alt="" class="img-fluid" style="height:350px; width:100%; object-fit:cover; object-position:center;">
                            </div>
                            @endif

                            <h2 class="entry-title">
                                <a href="{{ route('detail-news', $item->slug) }}">{{ $item->name }}</a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="icofont-user"></i> {{ $item->author->name }}</li>
                                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <time datetime="2021-03-25">{{ $item->created_at->diffForHumans() }}</time></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    {{ Str::limit($item->body ?? null, 100) }}
                                </p>
                                <div class="read-more">
                                    <a href="{{ route('detail-news', $item->slug) }}">Selengkapnya</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    {!! $profile->video_embed !!}
                </div>
                <div class="mt-2 mb-2">
                    <script type="text/javascript" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
                    <div id="gpr-kominfo-widget-container"></div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Blog Section -->

<section id="more" class="services">
    <div class="container">
        <div class="row">
            @if($information->count() > 0)
            <div class="col">
                <div class="section-title">
                    <h2>Information</h2>
                </div>
                @foreach($information as $item)
                <div class="row">
                    <div class="col-md-12">
                        <div class="icon-box d-flex align-items-center">
                            @if(Storage::disk('public')->exists($item->image ?? null))
                            <img src="{{ Storage::url($item->image ?? null ) }}" width="100" alt="">
                            @endif
                            <h4><a href="{{ route('information', $item->slug) }}">{{ $item->name ?? null }}</a></h4>
                            <p class="text-secondary">Event Date : {{ $item->event_date ?? null }} | Event Time : {{ $item->event_time ?? null }}</p>
                            <p>{{ Str::limit($item->body ?? null, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($events->count() > 0)
            <div class="col">
                <div class="section-title">
                    <!-- <p></p> -->
                    <h2>Events</h2>
                </div>
                @foreach($events as $item)
                <div class="row">
                    <div class="col">
                        <div class="icon-box align-items-center">
                            @if(Storage::disk('public')->exists($item->image ?? null))
                            <img src="{{ Storage::url($item->image ?? null ) }}" width="100" alt="">
                            @endif
                            <h4><a href="{{ route('event', $item) }}">{{ $item->name ?? null }}</a></h4>
                            <p class="text-secondary">Event Date : {{ $item->event_date ?? null }} | Event Time : {{ $item->event_time ?? null }}</p>
                            <p>{{ Str::limit($item->body ?? null, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>


@endsection