<!-- Contact info-->
<section class="section section-xs">
    <div class="container">
        <div class="row row-30 justify-content-sm-center features-list">
            <div class="col-md-4">
                <div class="unit flex-column unit-responsive-md section-45">
                    <div class="unit-left"><span class="icon icon-contact-sm text-madison mdi mdi-phone"></span></div>
                    <div class="unit-body"><a class="h6 text-regular" href="tel:#">{{ $university->phone ?? null }}</a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="unit flex-column unit-responsive-md section-45">
                    <div class="unit-left"><span class="icon icon-contact-sm text-madison mdi mdi-map-marker"></span></div>
                    <div class="unit-body"><a class="h6 text-regular" href="#">{{ $university->address ?? null }}</a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="unit flex-column unit-responsive-md section-45">
                    <div class="unit-left"><span class="icon icon-contact-sm text-madison mdi mdi-email-open"></span></div>
                    <div class="unit-body"><a class="h6 text-regular" href="mailto:{{ $university->email ?? '#' }}">{{ $university->email ?? null}}</a></div>
                </div>
            </div>
        </div>
    </div>
</section>