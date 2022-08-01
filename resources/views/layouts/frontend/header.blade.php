<header id="header" class="fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="logo mr-2 mt-n2">
                <div class="d-flex justify-content-between">
                    @if(Storage::disk('public')->exists($profile->image ?? null))
                    <img src="{{ Storage::url($profile->image ?? null) }}" alt="" class="img-fluid">
                    @endif
                    <div class="ml-2 text-secondary">
                        <h1 class="h5 font-weight-bolder">{{ $profile->name ?? null }}</h1>
                        <h6 class="mt-n2">Bolaang Mongondow</h6>
                    </div>
                </div>
            </a>
        </div>
        @include('layouts.frontend.nav')
    </div>
</header><!-- End Header -->