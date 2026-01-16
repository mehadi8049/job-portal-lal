<section class="section bg-white pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 d-none d-lg-block">
                <div class="cat-header d-flex justify-content-between">
                    <span>Discover Jobs Across Popular Category & Industry</span>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-secondary active">Category</button>
                    </div>
                </div>

                <div class="row">
                    @foreach ($functional_areas as $chunk)
                        <div class="col-md-4">
                            <ul class="cat-list">
                                @foreach ($chunk as $area)
                                    <li>
                                        <a href="{{ url('/jobs?functionalarea=' . $area->id) }}"><i
                                                class="pe-7s-right-arrow"></i>
                                            {{ $area->name }}
                                            <span class="cat-count">({{ $area->jobs_count }})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-3 col-md-12 mt-4 mt-lg-0">


                <div class="card-overseas">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="pe-7s-settings"></i> CV Builder</h5>
                        <span class="badge badge-primary">Resume</span>
                    </div>

                    <div class="mb-2">
                        <p class="mb-0 text-dark font-weight-bold">CV</p>
                        <p class="text-muted small">শিক্ষা, অভিজ্ঞতা ও দক্ষতার পূর্ণ বিবরণ</p>
                    </div>
                    <hr class="my-2">
                    <div class="mb-2">
                        <p class="mb-0 text-dark font-weight-bold">Resume</p>
                        <p class="text-muted small">আন্তর্জাতিক মানের সংক্ষিপ্ত জীবনবৃত্তান্ত</p>
                    </div>

                    <div class="mt-3">
                        <a href="{{ url('templates') }}" class="text-warning font-weight-bold small">Click Here</a>
                    </div>
                </div>
                <div class="card-overseas mt-2">

                    <div class="mt-2">
                        @if ($setting && filter_var($setting?->value, FILTER_VALIDATE_URL))
                            <img src="{{ $setting?->value }}" alt="Side bar ad" width="100%">
                        @else
                            {! $setting?->$setting->value !}
                        @endif
                    </div>
                </div>
                <div class="card-govt mt-3">
                    <h5><i class="pe-7s-plane"></i> GOVT JOBS</h5>
                    <div class="mt-3">
                        <p class="mb-1 text-dark font-weight-bold">সরকারি চাকরির সুযোগ</p>
                        <p class="text-muted small">আজকের সর্বশেষ সরকারি চাকরির খবর দেখুন এখানেই</p>
                    </div>
                    <div class="mt-3">
                        <a href="{{ url('jobs?organization_type=4') }}" class="text-success font-weight-bold small">VIEW
                            ALL</a>
                    </div>
                </div>


                <div class="mt-3 row">
                    <div class="col-6 pr-1">
                        <a href="{{ url('templates') }}" class="btn btn-yellow btn-block btn-sm text-white">Make
                            CV</a>
                    </div>
                    <div class="col-6 pl-1">
                        <a href="{{ url('jobs') }}" class="btn btn-primary btn-block btn-sm text-white">All Jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
