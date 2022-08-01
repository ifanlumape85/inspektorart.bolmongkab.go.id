<!-- Page Footer-->
<!-- Corporate footer-->
<footer class="page-footer">
    <div class="hr bg-gray-light"></div>
    <div class="container section-xs block-after-divider">
        <div class="row row-50 justify-content-xl-between justify-content-sm-center">
            <div class="col-sm-10 col-lg-4 col-xl-4 text-xl-left">
                <!--Footer brand--><a class="d-inline-block" href="/"><img width='170' height='172' src="{{ Storage::url($university->image ?? null) }}" alt='' />
                    <div>
                        <h6 class="barnd-name font-weight-bold offset-top-25">UNIMA</h6>
                    </div>
                    <div>
                        <p class="brand-slogan text-gray font-italic font-accent">{{ $university->name ?? null }}</p>
                    </div>
                </a>
            </div>
            <div class="col-sm-10 col-lg-4 col-xl-4 text-xl-left">
                <h6 class="font-weight-bold">Contact us</h6>
                <div class="text-subline"></div>
                <div class="offset-top-30">
                    <ul class="list-unstyled contact-info list">
                        <li>
                            <div class="unit flex-row align-items-center unit-spacing-xs">
                                <div class="unit-left"><span class="icon mdi mdi-phone text-middle icon-xs text-madison"></span></div>
                                <div class="unit-body">{{ $university->phone ?? null }}
                                </div>
                            </div>
                        </li>
                        <li class="offset-top-15">
                            <div class="unit flex-row align-items-center unit-spacing-xs">
                                <div class="unit-left"><span class="icon mdi mdi-map-marker text-middle icon-xs text-madison"></span></div>
                                <div class="unit-body text-left">{{ $university->address ?? null }}</div>
                            </div>
                        </li>
                        <li class="offset-top-15">
                            <div class="unit flex-row align-items-center unit-spacing-xs">
                                <div class="unit-left"><span class="icon mdi mdi-email-open text-middle icon-xs text-madison"></span></div>
                                <div class="unit-body"><a href="mailto:#">{{ $university->email ?? 'null' }}</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="offset-top-15 text-left">
                    <ul class="list-inline list-inline-xs list-inline-madison">
                        <li><a class="icon icon-xxs fa fa-facebook icon-circle icon-gray-light-filled" href="{{ $university->facebook ?? '#' }}"></a></li>
                        <li><a class="icon icon-xxs fa fa-twitter icon-circle icon-gray-light-filled" href="{{ $university->twitter ?? '#' }}"></a></li>
                        <li><a class="icon icon-xxs fa fa-google icon-circle icon-gray-light-filled" href="{{ $university->google_plus ?? '#' }}"></a></li>
                        <li><a class="icon icon-xxs fa fa-instagram icon-circle icon-gray-light-filled" href="{{ $university->instagram ?? '#' }}"></a></li>
                    </ul>
                </div>
            </div>
            @if($bottomMenus)
            @foreach($bottomMenus as $bottomMenu)
            <div class="col-sm-10 col-lg-4 col-xl-4 text-xl-left">
                <h6 class="font-weight-bold">{{ $bottomMenu->name ?? null }}</h6>
                <div class="text-subline"></div>
                <div class="offset-top-30">
                    @if($bottomMenu->pages)
                    <ul class="list-unstyled contact-info list">
                        @foreach($bottomMenu->pages as $page)
                        <li>
                            <div class="unit flex-row align-items-center unit-spacing-xs">
                                <div class="unit-left"><span class="icon mdi mdi-chevron-right text-middle icon-xs text-madison"></span></div>
                                <div class="unit-body">
                                    @if($page->link)
                                    <a href="{{ $page->link }}" target="_blank">{{ $page->name ?? null }}</a>
                                    @else
                                    <a href="{{ route('detail-page', $page->slug) }}">{{ $page->name ?? null }}</a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="bg-madison context-dark">
        <div class="container text-lg-left section-5">
            <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year">2020</span><span>.&nbsp;</span><span>All Rights Reserved</span><span>.&nbsp;</span><a href="{{ route('home') }}">Privacy Policy</a>.&nbsp;<a href="{{ route('home') }}">Universitas Negeri Manado</a></p>
        </div>
    </div>
</footer>