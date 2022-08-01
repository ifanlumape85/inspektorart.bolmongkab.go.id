@if($categories)
<h3 class="sidebar-title">Category</h3>
<div class="sidebar-item categories">
    <ul>
        @foreach($categories as $category)
        <li><a href="{{ route('category', $category) }}">{{ $category->name }} <span>({{ $category->news->count() }})</span></a></li>
        @endforeach
    </ul>
</div><!-- End sidebar categories-->
@endif