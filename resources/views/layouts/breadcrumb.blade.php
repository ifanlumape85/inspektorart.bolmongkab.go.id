<!-- Classic Breadcrumbs-->
<section class="section breadcrumb-classic context-dark">
    <div class="container">
        <h1>{{ $breadcrumb_h1 ?? null }}</h1>
        <div class="offset-top-10 offset-md-top-35">
            <ul class="list-inline list-inline-lg list-inline-dashed p">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li>{{ $breadcrumb_title ?? null }}</li>
            </ul>
        </div>
    </div>
</section>