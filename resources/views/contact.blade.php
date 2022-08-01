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
@section('maps')
<section class="section">
    <!--Please, add the data attribute data-key="YOUR_API_KEY" in order to insert your own API key for the Google map.-->
    <!--Please note that YOUR_API_KEY should replaced with your key.-->
    <!--Example: <div class="google-map-container" data-key="YOUR_API_KEY">-->
    <div class="google-map-container" data-center="{{ $university->name ?? null}}" data-zoom="5" data-icon="/template/frontend/images/gmap_marker.png" data-icon-active="/template/frontend/images/gmap_marker_active.png" data-styles="[{&quot;featureType&quot;:&quot;landscape&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:60}]},{&quot;featureType&quot;:&quot;road.local&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:40},{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;transit&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;administrative.province&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;water&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;},{&quot;lightness&quot;:30}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#ef8c25&quot;},{&quot;lightness&quot;:40}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.stroke&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.park&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#b6c54c&quot;},{&quot;lightness&quot;:40},{&quot;saturation&quot;:-40}]},{}]">
        <div class="google-map"></div>
        <ul class="google-map-markers">
            <li data-location="{{ $university->name ?? null}}" data-description="{{ $university->name ?? null}}"></li>
        </ul>
    </div>
</section>
@endsection
@section('content')
<section class="section section-xl bg-default">
    <div class="container">
        <div class="row row-50 justify-content-sm-center">
            <div class="col-sm-10 col-lg-8 text-lg-left">
                <h2 class="font-weight-bold">Get in Touch</h2>
                <hr class="divider bg-madison divider-lg-0">
                <div class="offset-top-30 offset-md-top-60">
                    <p>You can contact us any way that is convenient for you. We are available 24/7 via fax or email. You can also use a quick contact form below or visit our office personally. We would be happy to answer your questions.</p>
                </div>
                <div class="offset-top-30">
                    <form class="text-left" method="post" action="{{ route('contact-store') }}">
                        @csrf

                        <div class="row row-12">
                            <div class="col-xl-6">
                                <div class="form-wrap">
                                    <label class="form-label form-label-outside" for="contact-me-name">First name</label>
                                    <input class="form-input" id="contact-me-name" type="text" name="first_name" data-constraints="@Required">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-wrap">
                                    <label class="form-label form-label-outside" for="contact-me-last-name">Last name</label>
                                    <input class="form-input" id="contact-me-last-name" type="text" name="last_name" data-constraints="@Required">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-wrap">
                                    <label class="form-label form-label-outside" for="contact-me-email">E-mail</label>
                                    <input class="form-input" id="contact-me-email" type="email" name="email" data-constraints="@Required @Email">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-wrap">
                                    <label class="form-label form-label-outside" for="contact-me-phone">Phone</label>
                                    <input class="form-input" id="contact-me-phone" type="text" name="phone" data-constraints="@Required @IsNumeric">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-wrap">
                                    <label class="form-label form-label-outside" for="contact-me-message">Message</label>
                                    <textarea class="form-input" id="contact-me-message" name="message" data-constraints="@Required" style="height: 220px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-xl-left offset-top-20">
                            <button class="btn button-primary" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-10 col-lg-4 text-left">
                <div class="inset-lg-left-30">
                    <h6 class="font-weight-bold">Socials</h6>
                    <div class="hr bg-gray-light offset-top-10"></div>
                    <ul class="list-inline list-inline-xs list-inline-madison">
                        <li><a class="icon novi-icon icon-xxs fa fa-facebook icon-circle icon-gray-light-filled" href="{{ $university->facebbok ?? null}}"></a></li>
                        <li><a class="icon novi-icon icon-xxs fa fa-twitter icon-circle icon-gray-light-filled" href="{{ $university->twitter ?? null}}"></a></li>
                        <li><a class="icon novi-icon icon-xxs fa fa-google icon-circle icon-gray-light-filled" href="{{ $university->google_plus ?? null}}"></a></li>
                        <li><a class="icon novi-icon icon-xxs fa fa-instagram icon-circle icon-gray-light-filled" href="{{ $university->instagram ?? null}}"></a></li>
                    </ul>
                    <div class="offset-top-30 offset-md-top-60">
                        <h6 class="font-weight-bold">Phones</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <ul class="list list-unstyled">
                                <?php
                                $collections = Str::of($university->phone)->explode(', ');
                                ?>
                                @foreach($collections as $collection)
                                <li><span class="icon icon-xs text-madison mdi mdi-phone text-middle"></span><a class="text-middle inset-left-10 text-dark" href="tel:{{ $collection }}">{{ $collection }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="offset-top-30 offset-md-top-60">
                        <h6 class="font-weight-bold">E-mail</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <ul class="list list-unstyled">
                                <li><span class="icon icon-xs text-madison mdi mdi-email-outline text-middle"></span><a class="text-primary text-middle inset-left-10" href="mailto:{{ $university->email ?? null}}">{{ $university->email ?? null }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="offset-top-30 offset-md-top-60">
                        <h6 class="font-weight-bold">Address</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <div class="unit flex-row unit-spacing-xs">
                                <div class="unit-left"><span class="icon icon-xs mdi mdi-map-marker text-madison"></span></div>
                                <div class="unit-body">
                                    <p><a class="text-dark" href="#">{{ $university->address ?? null }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-top-30 offset-md-top-65">
                        <h6 class="font-weight-bold">Opening Hours</h6>
                        <div>
                            <div class="hr bg-gray-light offset-top-10"></div>
                        </div>
                        <div class="offset-top-15">
                            <div class="unit flex-row unit-spacing-xs">
                                <div class="unit-left"><span class="icon icon-xs mdi mdi-calendar-clock text-madison"></span></div>
                                <div class="unit-body">
                                    {{ $university->opening_hours ?? null }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection