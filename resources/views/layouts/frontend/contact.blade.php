<section id="kontak" class="contact">
    <div class="container">
        <div class="section-title">
            <h2>Contact</h2>
        </div>

        <div>
            {!! $profile->google_maps ?? null !!}
        </div>

        <div class="row mt-5">
            <div class="col text-center">
                <div class="info">
                    <div>
                        <i class="icofont-google-map h4"></i>
                    </div>
                    <div class="address">
                        <span class="text-secondary">{{ $profile->address ?? null }}</span>
                    </div>
                </div>
            </div>

            <div class="col text-center">
                <div class="info">
                    <div>
                        <i class="icofont-envelope h4"></i>
                    </div>
                    <div class="email">
                        <span class="text-secondary">{{ $profile->email ?? null }}</span>
                    </div>
                </div>
            </div>

            <div class="col text-center">
                <div class="info">
                    <div>
                        <i class="icofont-phone h4"></i>
                    </div>
                    <div class="phone">
                        <span class="text-secondary">{{ $profile->phone ?? null }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>