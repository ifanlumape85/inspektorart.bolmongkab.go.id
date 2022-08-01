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
<section class="section section-xl bg-default">
    <div class="container">
        <div class="row row-50 justify-content-sm-center">
            <div class="col-md-6 text-left">
                <div class="inset-md-right-30">
                    @if(Storage::disk('public')->exists($event->image ?? nulll))
                    <img class="img-responsive d-inline-block" src="{{ Storage::url($event->image ?? null) }}" width="540" height="540" alt="">
                    @endif
                    <div class="offset-top-30 offset-lg-top-60">
                        <h6 class="font-weight-bold">A Few Words About Lecturer</h6>
                        <div class="text-subline"></div>
                    </div>
                    <div class="offset-top-20 text-center text-sm-left">
                        <div class="unit unit-xs flex-column flex-sm-row unit-spacing-lg">
                            <div class="unit-left">
                                @if(Storage::disk('public')->exists($event->lecture->image ?? null))
                                <img class="img-responsive d-inline-block img-rounded" src="{{ Storage::url($event->lecture->image ?? null) }}" width="110" height="110" alt="">
                            </div>
                            @endif
                            <div class="unit-body">
                                <h6 class="font-weight-bold text-primary">{{ $event->lecture->name ?? null }}</h6>
                                <div class="offset-sm-top-30">
                                    <ul class="list list-unstyled">
                                        <li><span class="icon icon-xs mdi mdi-phone text-middle"></span><a class="d-inline-block text-black inset-left-10" href="tel:#">{{ $event->lecture->phone ?? null }}</a></li>
                                        <li><span class="icon icon-xs mdi mdi-email-outline text-middle"></span><a class="d-inline-block inset-left-10" href="mailto:{{ $event->lecture->email ?? null }}">{{ $event->lecture->email }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="offset-top-20">
                            <p>{{ $event->lecture->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-left">
                <h2 class="font-weight-bold">{{ $event->name ?? null }}</h2>
                <div class="hr divider bg-madison hr-left-0"></div>
                <div class="offset-top-30 offset-lg-top-60">
                    {{ $event->body ?? null }}
                </div>
                <div class="offset-top-30 offset-lg-top-60">
                    <h6 class="font-weight-bold">When is the next workshop and how do I apply?</h6>
                    <div class="text-subline"></div>
                </div>
                <div class="offset-top-17">
                    <p>Details of the next available workshop are below:</p>
                    <ul class="list list-unstyled">
                        <li><span class="text-black">Date:</span> <span>{{ $event->event_date ?? null }}</span>
                        </li>
                        <li><span class="text-black">Times:</span> <span>{{ $event->event_time ?? null }}</span>
                        </li>
                        <li><span class="text-black">Fee:</span> <span>IDR{{ $event->fee ?? null  }}</span>
                        </li>
                        <li><span class="text-black">Location:</span> <span>{{ $event->location ?? null }}</span>
                        </li>
                    </ul>
                    <div class="offset-top-30 offset-lg-top-60">
                        <h6 class="font-weight-bold">What you need to bring</h6>
                        <div class="text-subline"></div>
                    </div>
                    <div class="offset-top-20">
                        {{ $event->need_to_bring ?? null }}
                    </div>
                    <div class="offset-top-30"><a class="btn button-primary" href="{{ route('apply', $event->slug) }}">Apply Now</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Events-->
<section class="section bg-catskill">
    <div class="container container-wide section-xl">
        <h2 class="font-weight-bold">Other Events</h2>
        <hr class="divider bg-madison">
        <div class="row row-50 offset-top-60 justify-content-sm-center">
            @foreach($events as $ev)
            <div class="col-md-6 col-lg-5 col-xxl-3">
                <article class="post-event">
                    <div class="post-event-img-overlay">
                        @if(Storage::disk('public')->exists($ev->image ?? null))
                        <img class="img-responsive" src="{{ Storage::url($ev->image ?? null) }}" width="420" height="420" alt="">
                        @endif
                        <div class="post-event-overlay context-dark">
                        <!-- <a class="btn button-primary" href="apply.html">Book Now</a> -->
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