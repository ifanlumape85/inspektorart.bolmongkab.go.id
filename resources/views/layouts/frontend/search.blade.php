<h3 class="sidebar-title">Search</h3>
<div class="sidebar-item search-form">
    <form action="{{ route('search') }}" method="post">
        @csrf
        <input type="text" name="s" id="s">
        <button type="submit"><i class="icofont-search"></i></button>
    </form>

</div><!-- End sidebar search formn-->