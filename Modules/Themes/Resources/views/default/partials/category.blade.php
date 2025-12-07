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
                <div class="card-govt">
                    <h5><i class="pe-7s-plane"></i> GOVT JOBS</h5>
                    <div class="mt-3">
                        <p class="mb-1 text-dark font-weight-bold">বাংলাদেশ নৌবাহিনী</p>
                        <p class="text-muted small">কমিশন্ড অফিসার বিশেষজ্ঞ চিকিৎসক</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-success font-weight-bold small">VIEW ALL (240)</a>
                    </div>
                </div>

                <div class="card-overseas mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="pe-7s-world"></i> বিদেশ চাকরি</h5>
                        <span class="badge badge-primary">JOBS</span>
                    </div>

                    <div class="mb-2">
                        <p class="mb-0 text-dark font-weight-bold">BJIT Ltd.</p>
                        <p class="text-muted small">CAD and Construction Management Engineer</p>
                    </div>
                    <hr class="my-2">
                    <div class="mb-2">
                        <p class="mb-0 text-dark font-weight-bold">Solar World Power BD</p>
                        <p class="text-muted small">Call Center Agent, Australia</p>
                    </div>

                    <div class="mt-3">
                        <a href="#" class="text-warning font-weight-bold small">View All (37)</a>
                    </div>
                </div>

                <div class="mt-3 row">
                    <div class="col-6 pr-1">
                        <a href="#" class="btn btn-success btn-block btn-sm text-white">Post your CV</a>
                    </div>
                    <div class="col-6 pl-1">
                        <a href="#" class="btn btn-danger btn-block btn-sm text-white">Video CV</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
