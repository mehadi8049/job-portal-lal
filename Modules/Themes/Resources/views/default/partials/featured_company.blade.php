@isset($companies)
    <section class="section pt-4 pb-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0 mr-2">Featured Companies</h4>
                        <span class="badge badge-danger">Hot Jobs</span>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($companies as $company)
                    <div class="col-lg-3 col-md-6 mb-4 card-padding">
                        <a href="#" class="company-item-card">



                            <div class="company-logo-wrap">
                                <img src="{{ $company->getLogoLink() }}" class="company-logo-img"
                                    alt="{{ $company->name ?? 'Company Name' }}">
                            </div>

                            <div class="company-info">
                                <h6 class="" title="{{ $company->name ?? 'Company Name' }}">
                                    {{ $company->name ?? 'Company Name' }}
                                </h6>

                            </div>
                        </a>
                    </div>
                @endforeach

                {{-- STATIC EXAMPLE (If $companies is empty) --}}
                @if (!count($companies))
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <a href="#" class="company-item-card">
                                @if ($i == 0)
                                    {{-- <span class="featured-badge">FEATURED</span> --}}
                                @endif
                                <div class="company-logo-wrap">
                                    <img src="{{ asset('modules/themes/default/images/arrow-1.png') }}"
                                        class="company-logo-img" alt="Example Company">
                                </div>
                                <div class="company-info">
                                    <h6 class="text-truncate" title="Innovative Solutions Ltd.">
                                        Innovative Solutions Ltd.
                                    </h6>
                                    <div class="company-meta-item">
                                        <i class="pe-7s-map-marker"></i> Remote/Dhaka
                                    </div>
                                    <div class="company-meta-item">
                                        <i class="pe-7s-folder"></i> Software & Tech
                                    </div>
                                    <div class="company-meta-item">
                                        <i class="pe-7s-airplay"></i> <span class="font-weight-bold text-success">8</span>
                                        Open Jobs
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
@endisset
