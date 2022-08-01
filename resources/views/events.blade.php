@extends('layouts.frontend.app')
@push('addon-style')
<style>
    .ie-panel {
        display: none;
        background: #212121;
        padding: 10px 0;
        box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
        clear: both;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    html.ie-10 .ie-panel,
    html.lt-ie-10 .ie-panel {
        display: block;
    }
</style>

@endpush
@section('content')
<!-- Events-->
<section class="section bg-catskill">
    <div class="container container-wide section-xl">
        <h2 class="font-weight-bold">Events Calendar</h2>
        <hr class="divider bg-madison">
        <div class="row row-50 offset-top-60 justify-content-sm-center">
            @foreach($events as $ev)
            <div class="col-md-6 col-lg-5 col-xxl-3">
                <article class="post-event">
                    <div class="post-event-img-overlay">
                        @if(Storage::disk('public')->exists($ev->image ?? null))
                        <img class="img-responsive" src="{{ Storage::url($ev->image ?? null) }}" width="420" height="420" alt="">
                        @endif
                        <div class="post-event-overlay context-dark"><a class="btn button-primary" href="apply.html">Book Now</a>
                            <div class="offset-top-20"><a class="btn button-default" href="{{ route('event', $ev->slug) }}">Learn More</a></div>
                        </div>
                    </div>
                    <div class="unit unit-lg flex-column flex-xl-row">
                        <div class="unit-left">
                            <div class="post-event-meta text-center">
                                <div class="h3 font-weight-bold d-inline-block d-xl-block">{{ date('d', strtotime($ev->event_date ?? null )) }}</div>
                                <p class="d-inline-block d-xl-block">{{ date('F', strtotime($ev->event_date ?? null)) }}</p><span class="font-weight-bold d-inline-block d-xl-block inset-left-10 inset-xl-left-0">{{ date('H:i A', strtotime($ev->event_time ?? null)) }}</span>
                            </div>
                        </div>
                        <div class="unit-body">
                            <div class="post-event-body text-xl-left">
                                <h6><a href="event-page.html">{{ $ev->name ?? null }}</a></h6>
                                <ul class="list-inline list-inline-xs">
                                    <li><a href="team-member-profile.html"><span class="icon icon-xxs mdi mdi-account-outline text-middle"></span><span class="inset-left-10 text-dark text-middle">{{ $ev->lecture->name ?? null }}</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection