<section class="bg-home" id="home">
    <div class="container hero-container">
        <div class="row">
            <div class="col-lg-9 col-md-12">

                <div class="mb-5 mt-3">
                    <h1 class="hero-title mb-2">Find Your Next Job</h1>
                </div>

                <div class="row mb-4">
                    <div class="col-6 col-md-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-circle"><i class="pe-7s-graph1"></i></div>
                            <div class="stat-text">
                                <h3>{{ $total_job->not_expired_jobs }}</h3>
                                <p>Current Jobs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-circle"><i class="pe-7s-users"></i></div>
                            <div class="stat-text">
                                <h3>{{ $total_functional_areas }}</h3>
                                <p>Opportunities</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-circle"><i class="pe-7s-portfolio"></i></div>
                            <div class="stat-text">
                                <h3>{{ $total_companies }}</h3>
                                <p>Organizations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-circle"><i class="pe-7s-rocket"></i></div>
                            <div class="stat-text">
                                <h3>{{ $total_job->last_7_days_jobs }}</h3>
                                <p>Latest Jobs</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <form action="{{ route('jobslist') }}" method="GET" class="d-none d-md-block">
                            <div class="bd-search-box">
                                <div style="flex: 2; position: relative;">
                                    <i class="pe-7s-search"
                                        style="position: absolute; left: 10px; top: 14px; font-weight: bold;"></i>
                                    <input type="text" class="form-control" name="keyword"
                                        placeholder="Search by keyword" style="padding-left: 30px;">
                                </div>
                                <div style="flex: 2;">
                                    <select class="form-control" name="organization_type">
                                        <option value="">Organization Type</option>
                                        @foreach ($organization_types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-search">Search</button>
                                </div>
                            </div>
                        </form>

                        <form id="form_search" action="{{ route('jobslist') }}" method="GET"
                            class="mobile-search-form d-block d-md-none">
                            <div class="row">
                                <div class="form-group col-12">
                                    <input class="form-control" name="keyword"
                                        placeholder="Job title, position you want to apply for" autocomplete="off">
                                </div>

                                <div class="form-group col-12">
                                    <select class="form-control" name="functional_area">
                                        <option value="">All Functional Areas</option>
                                        @foreach ($functional_areas as $chunk)
                                            @foreach ($chunk as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <select class="form-control" name="city">
                                        <option value="">All location</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary">Search Jobs</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>

            <div class="col-lg-3 d-none d-lg-block">
                <div class="quick-links-box">
                    <h5>Quick Links</h5>
                    <ul class="quick-links-list">
                        @foreach ($quick_links as $link)
                            <li>
                                <a href="{{ $link->link_url }}" target="_blank">
                                    <i class="pe-7s-right-arrow"></i> {{ $link->title }}
                                    @if ($loop->first)
                                        <span class="badge-new">new</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
