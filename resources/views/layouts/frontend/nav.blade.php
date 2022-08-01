<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li class="active"><a href="{{ route('home') }}" class="text-uppercase">Beranda</a></li>
        @isset($menus)
        @foreach($menus as $menu)
        <li class="drop-down"><a href="{{ $menu->link == null ? env('APP_URL') : env('APP_URL').'/'.$menu->link }}" class="text-uppercase">{{ $menu->name }}</a>
            @if($menu->pages)
            <ul>
                @foreach($menu->pages as $page)
                @if($page->link)
                <li><a href="{{ $page->link ?? null }}" class="text-uppercase">{{ $page->name ?? null }}</a></li>
                @else
                <li><a href="{{ route('detail-page', $page->slug) }}" class="text-uppercase">{{ $page->name ?? null }}</a></li>
                @endif
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
        @endisset
    </ul>
</nav><!-- .nav-menu -->