@if($recents)
<h3 class="sidebar-title">Recents</h3>
<div class="sidebar-item recent-posts">
    @foreach($recents as $recent)
    <div class="post-item clearfix">
        @if(Storage::disk('public')->exists($recent->image ?? null))
        <img src="{{ Storage::url($recent->image ?? null) }}" alt="">
        @endif
        <h4><a href="{{ route('news', $recent) }}">{{ $recent->name }}</a></h4>
        <time datetime="{{ $recent->created_at }}">{{ $recent->created_at }}</time>
    </div>
    @endforeach
</div><!-- End sidebar recent posts-->
@endif