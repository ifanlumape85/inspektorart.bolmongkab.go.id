<aside class="inset-lg-left-30">
    <h6 class="font-weight-bold">Search</h6>
    <div class="text-subline"></div>
    <div class="offset-top-30">
        <!-- RD Search Form-->
        <form class="form-search rd-search form-search-widget rd-form-inline rd-form-inline-custom" action="{{ route('search') }}" method="GET">
            <div class="form-wrap">
                <div class="input-group">
                    <input class="form-search-input  form-input" type="text" name="s" autocomplete="off"><span class="input-group-btn">
                        <button class="btn button-primary" type="submit"><span class="icon fa fa-search"></span></button></span>
                </div>
            </div>
        </form>
    </div>
    @include('layouts.archive')
    @include('layouts.gallery')
    @include('layouts.category')
    @include('layouts.mode')
    @include('layouts.academic')
    @include('layouts.fb-widget')
    @include('layouts.recent')
    @include('layouts.banner')
    @include('layouts.tags')
</aside>