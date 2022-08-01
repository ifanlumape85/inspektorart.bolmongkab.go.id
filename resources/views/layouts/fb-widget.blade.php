@isset($university)
<div class="offset-top-60">
    <!-- Facebook standart widget-->
    <div>
        <div class="fb-root fb-widget">
            <div class="fb-page-responsive">
                <div class="fb-page" data-href="{{ $university->facebook ?? null }}" data-tabs="timeline" data-height="220" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="{{ $university->facebook ?? null }}"><a href="{{ $university->facebook ?? null }}">{{ $university->name ?? null }}</a></blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset