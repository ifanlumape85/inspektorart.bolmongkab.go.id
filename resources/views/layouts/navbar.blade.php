<ul class="rd-navbar-nav">
    <li class="active"><a href="{{ route('home') }}">Home</a>
    </li>
    @isset($menus)
    @foreach($menus as $menu)
    @if($menu->mega_menu == 'N')
    <li><a href="#">{{ $menu->name ?? null }}</a>
        <ul class="rd-navbar-dropdown">
            @foreach($menu->pages as $page)
            @if($page->link)
            <li><a href="{{ $page->link }}">{{ $page->name ?? null }}</a>
            </li>
            @else
            <li><a href="{{ route('detail-page', $page->slug) }}">{{ $page->name ?? null }}</a>
            </li>
            @endif
            @endforeach
        </ul>
    </li>
    @else
    <li><a href="#">{{ $menu->name ?? null }}</a>
        <div class="rd-navbar-megamenu">
            <div class="row section-relative">
                @if(count($groups) > 0)
                @foreach($groups as $group)
                @if(count($group->pages) > 0)
                <ul class="col-xl-3">
                    <li>
                        <h6>{{ $group->name ?? null }}</h6>
                        <ul class="list-unstyled offset-lg-top-20">
                            @foreach($group->pages as $page)
                            <li>
                                @if($page->link)
                                <a href="{{ $page->link }}" target="_blank">{{ $page->name ?? null }}</a>
                                @else
                                <a href="{{ route('detail-page', $page->slug) }}">{{ $page->name ?? null }}</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </li>

    @endif
    @endforeach
    @endisset

    @isset($categories)
    @if($categories)
    <li><a href="{{ route('news') }}">News</a>
        <ul class="rd-navbar-dropdown">
            @foreach($categories as $category)
            <li><a href="{{ route('category', $category->slug) }}">{{ $category->name ?? null }}</a>
            </li>
            @endforeach
        </ul>
    </li>
    @endif
    @endisset

</ul>