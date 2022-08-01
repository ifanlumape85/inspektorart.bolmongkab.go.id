@if($tags)
<h3 class="sidebar-title">Tags</h3>
<div class="sidebar-item tags">
    <ul>
        @foreach($tags as $tag)
        <li><a href="{{ route('tag', $tag) }}">{{ $tag->name }}</a></li>
        @endforeach
    </ul>
</div><!-- End sidebar tags-->
@endif