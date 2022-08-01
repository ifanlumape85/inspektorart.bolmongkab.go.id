<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                        <img src="{{ Storage::url($profile->image ?? null ) }}" width="64px" />
                        <h3>{{ $profile->name ?? null }}</h3>
                        <p class="text-white mt-n4 mb-4">Bolaang Mongondow</p>
                        <strong>Sosial Media</strong><br>
                        <div class="social-links mt-3">
                            <a href="{{ $profile->twitter ?? null }}" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="{{ $profile->facebook ?? null }}" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="{{ $profile->instagram ?? null }}" class="instagram"><i class="bx bxl-instagram"></i></a>
                        </div>
                    </div>
                </div>
                @isset($bottomMenus)
                @foreach($bottomMenus as $bottomMenu)
                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>{{ $bottomMenu->name ?? null }}</h4>
                    @if($bottomMenu->pages)
                    <ul>
                        @foreach($bottomMenu->pages as $page)
                        @if($page->link)
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ $page->link }}">{{ $page->name ?? null }}</a></li>
                        @else
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('detail-page', $page->slug) }}">{{ $page->name ?? null }}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endforeach
                @endisset
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright 2021 <strong><span>{{ $profile->name ?? null }}</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Powered by <a href="https://diskominfo.bolmongkab.go.id/">e-Government</a>
        </div>
    </div>
</footer><!-- End Footer -->