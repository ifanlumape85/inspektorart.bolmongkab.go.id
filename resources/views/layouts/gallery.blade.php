@isset($galleries)
<div class="offset-top-60">
    <!-- Flickr Feed-->
    <h6 class="font-weight-bold">Gallery</h6>
    <div class="text-subline"></div>
    <div class="offset-top-20 text-left">
        <div class="flickr widget-flickrfeed" data-lightgallery="group">
            @foreach($galleries as $gallery)
            <a class="thumbnail-default" style="float: left;" data-lightgallery="item" href="{{ Storage::url($gallery->image ?? null ) }}">
                <img width="170" height="170" data-title="alt" src="{{ Storage::url($gallery->image ?? null ) }}" alt="">
                <span class="icon fa fa-search-plus"></span>
            </a>
            @endforeach
        </div>
    </div>
</div>
<div style="display: block; clear:both;"></div>
@endisset