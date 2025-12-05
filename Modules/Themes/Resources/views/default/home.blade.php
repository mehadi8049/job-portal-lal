@extends('themes::default.layout')

@push('head')
    <style>
        /* --- General Overrides --- */
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f6f8;
        }

        a {
            text-decoration: none !important;
        }

        /* --- Hero Section & Stats --- */
        .bg-home {
            background-image: url("{{ asset('modules/themes/default/images/home_slider.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            /* padding: 40px 0; */
            /* Reduced top padding slightly */
            position: relative;
        }

        .bg-overlay {
            background-color: rgba(255, 255, 255, 0.1);
            /* Lighter overlay to see bg image, or adjust to match pref */
            /* If you want the dark blue overlay like before, use rgba(0, 50, 100, 0.6) */
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .hero-container {
            position: relative;
            z-index: 2;
        }

        /* Left Side Content Styles */
        .hero-title {
            color: #333;
            /* Dark text if bg is light, or White if bg is dark. Adjust based on your background image */
            font-weight: 700;
        }

        .hero-subtitle {
            color: #555;
        }

        /* Stats Circle */
        .stat-circle {
            width: 50px;
            height: 50px;
            background: #296dc1;
            /* Blue circle */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            margin-right: 15px;
        }

        .stat-text h3 {
            font-size: 22px;
            font-weight: 700;
            color: #296dc1;
            margin: 0;
        }

        .stat-text p {
            color: #666;
            margin: 0;
            font-size: 12px;
            text-transform: uppercase;
        }

        /* Main Search Box */
        .bd-search-box {
            background: rgba(0, 50, 100, 0.7);
            /* Semi-transparent dark blue background */
            padding: 15px;
            border-radius: 4px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .bd-search-box .form-control {
            border: 1px solid #fff;
            height: 45px;
            border-radius: 4px;
        }

        .bd-search-box .btn-search {
            background-color: #8bc34a;
            /* Green button */
            color: #fff;
            font-weight: 600;
            padding: 0 30px;
            border: none;
            height: 45px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* --- Quick Links Sidebar (New) --- */
        .quick-links-box {
            background-color: #2457959c;
            /* Dark Blue Background */
            color: #fff;
            padding: 20px;
            height: 100%;
            min-height: 380px;
            border-radius: 4px;
            /* blur */
            backdrop-filter: blur(5px);
        }

        .quick-links-box h5 {
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 16px;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 10px;
        }

        .quick-links-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .quick-links-list li {
            margin-bottom: 12px;
            font-size: 14px;
        }

        .quick-links-list li a {
            color: #e6ecf5;
            display: block;
            transition: color 0.2s;
        }

        .quick-links-list li a:hover {
            color: #fff;
            text-decoration: underline !important;
        }

        .quick-links-list li a i {
            margin-right: 5px;
            font-size: 10px;
        }

        .badge-new {
            background-color: #ffeb3b;
            /* Yellow badge */
            color: #000;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 3px;
            font-weight: 700;
            margin-left: 5px;
            text-transform: lowercase;
            vertical-align: middle;
        }

        /* --- Category Section & Sidebar CSS (Kept from previous) --- */
        .cat-section {
            background: #fff;
            border-bottom: 1px solid #ddd;
            padding: 20px 0;
        }

        .cat-header {
            font-size: 18px;
            font-weight: 700;
            color: #0056b3;
            margin-bottom: 20px;
        }

        .cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cat-list li {
            margin-bottom: 12px;
        }

        .cat-list li a {
            color: #444;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .cat-list li a:hover {
            color: #0056b3;
        }

        .cat-list li a i {
            font-size: 10px;
            color: #888;
            margin-right: 8px;
        }

        .cat-count {
            color: #888;
            font-size: 12px;
            margin-left: 5px;
        }

        .card-govt {
            background-color: #fff9e6;
            border: 1px solid #f5eaca;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .card-govt h5 {
            color: #0056b3;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-overseas {
            background-color: #fff;
            border: 1px solid #e1e7ec;
            border-radius: 4px;
            padding: 15px;
        }

        .card-overseas h5 {
            color: #e65100;
            font-weight: 700;
            font-size: 16px;
        }

        /* --- Featured Company Card (New Design) --- */
        .company-item-card {
            background: #fff;
            border: 1px solid #e5e5e5;
            padding: 15px;
            border-radius: 8px;
            /* Slightly more modern roundness */
            display: flex;
            align-items: flex-start;
            /* Align logo and content to the top */
            gap: 15px;
            height: 100%;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none !important;
        }

        /* Bottom Border Hover Effect */
        .company-item-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-color: #0056b3;
            /* Highlight border on hover */
        }

        .company-item-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            /* Height of the hover border */
            background-color: #00b074;
            /* Vibrant accent color */
            transform: translateY(100%);
            transition: transform 0.3s ease-out;
        }

        .company-item-card:hover::after {
            transform: translateY(0);
        }


        .company-logo-img {
            width: 30px;
            height: 30px;
            object-fit: contain;
            border: 1px solid #f0f0f0;
            padding: 5px;
            border-radius: 4px;
        }

        .company-info {
            flex-grow: 1;
        }

        .company-info h6 {
            font-size: 14px;
            color: #2c3e50;
            margin: 0 0 5px 0;
            font-weight: 700;
            line-height: 1.2;
        }

        .company-meta-item {
            font-size: 12px;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            margin-bottom: 3px;
        }

        .company-meta-item i {
            font-size: 13px;
            margin-right: 5px;
            color: #95a5a6;
        }

        .featured-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #f39c12;
            /* Orange/Gold for Featured */
            color: white;
            font-size: 10px;
            padding: 3px 8px;
            border-top-right-radius: 7px;
            border-bottom-left-radius: 7px;
            font-weight: 700;
        }

        /* Remove the old hot-job-card styling if not used elsewhere */
        .hot-job-card {
            /* Keeping this style to avoid breaking other parts, but we'll use .company-item-card for the new design */
            display: none;
        }

        .hot-job-img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border: 1px solid #f0f0f0;
            padding: 2px;
            border-radius: 4px;
        }

        .hot-job-info h6 {
            font-size: 14px;
            color: #0056b3;
            margin: 0 0 2px 0;
            font-weight: 600;
            line-height: 1.2;
        }

        .hot-job-info span {
            font-size: 12px;
            color: #333;
            display: block;
            line-height: 1.2;
        }


        /* custom */

        .col-lg-3 {
            padding: 0 2px !important;
            height: auto !important;
        }
    </style>
@endpush

@section('content')
    <section class="bg-home" id="home">
        <div class="container hero-container">
            <div class="row">
                <div class="col-lg-9 col-md-12">

                    <div class="mb-5 mt-4">
                        <h1 class="hero-title mb-2">Find the right job</h1>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-circle"><i class="pe-7s-graph1"></i></div>
                                <div class="stat-text">
                                    <h3>5,354</h3>
                                    <p>Live Jobs</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-circle"><i class="pe-7s-users"></i></div>
                                <div class="stat-text">
                                    <h3>20,192</h3>
                                    <p>Vacancies</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-circle"><i class="pe-7s-portfolio"></i></div>
                                <div class="stat-text">
                                    <h3>3,126</h3>
                                    <p>Companies</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-circle"><i class="pe-7s-rocket"></i></div>
                                <div class="stat-text">
                                    <h3>361</h3>
                                    <p>New Jobs</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('jobslist') }}" method="GET">
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
                                            <option value="Government">Government</option>
                                            <option value="Semi Government">Semi Government</option>
                                            <option value="NGO">NGO</option>
                                            <option value="Private">Private Firm</option>
                                        </select>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-search">Search</button>
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
                            <li><a href="#">&raquo; Employer List (3126)</a></li>
                            <li><a href="#">&raquo; New Jobs (360)</a></li>
                            <li><a href="#">&raquo; Deadline Tomorrow (515)</a></li>
                            <li><a href="#">&raquo; Internship Opportunity (69) <span class="badge-new">new</span></a>
                            </li>
                            <li><a href="#">&raquo; Contractual Jobs (177)</a></li>
                            <li><a href="#">&raquo; Part time Jobs (36)</a></li>
                            <li><a href="#">&raquo; Overseas Jobs (36)</a></li>
                            <li><a href="#">&raquo; Work From Home (73)</a></li>
                            <li><a href="#">&raquo; Fresher Jobs (1479)</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section bg-white pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="cat-header d-flex justify-content-between">
                        <span>Discover Jobs Across Popular Category & Industry</span>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-secondary active">Category</button>
                            <button class="btn btn-light border">Industry</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <ul class="cat-list">
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Accounting/Finance <span
                                            class="cat-count">(400)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Bank/ Non-Bank Fin. <span
                                            class="cat-count">(82)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Supply Chain/ Procure <span
                                            class="cat-count">(147)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Education/Training <span
                                            class="cat-count">(454)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Engineer/Architects <span
                                            class="cat-count">(362)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Garments/Textile <span
                                            class="cat-count">(619)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> HR/Org. Development <span
                                            class="cat-count">(169)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Gen Mgt/Admin <span
                                            class="cat-count">(185)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Healthcare/Medical <span
                                            class="cat-count">(204)</span></a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="cat-list">
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Production/Operation <span
                                            class="cat-count">(155)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Hospitality/ Travel <span
                                            class="cat-count">(203)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Commercial <span
                                            class="cat-count">(74)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> IT & Telecommunication <span
                                            class="cat-count">(338)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Marketing/Sales <span
                                            class="cat-count">(1085)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Customer Service/Call <span
                                            class="cat-count">(195)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Media/Ad./Event Mgt. <span
                                            class="cat-count">(169)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Pharmaceutical <span
                                            class="cat-count">(97)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Electrician/Technician <span
                                            class="cat-count">(22)</span></a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="cat-list">
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Agro (Plant/Animal) <span
                                            class="cat-count">(88)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> NGO/Development <span
                                            class="cat-count">(226)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Research/Consultancy <span
                                            class="cat-count">(23)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Receptionist/ PS <span
                                            class="cat-count">(66)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Data Entry/Operator <span
                                            class="cat-count">(39)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Design/Creative <span
                                            class="cat-count">(173)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Security/Support Service <span
                                            class="cat-count">(47)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Law/Legal <span
                                            class="cat-count">(39)</span></a></li>
                                <li><a href="#"><i class="pe-7s-angle-right"></i> Others <span
                                            class="cat-count">(14)</span></a></li>
                            </ul>
                            <div class="text-right mt-2">
                                <a href="#" class="text-primary font-weight-bold">More +</a>
                            </div>
                        </div>
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
                        <div class="col-lg-3 col-md-6 mb-4">
                            <a href="#" class="company-item-card">

                                {{-- Check if the company is featured and display badge --}}
                                @if (isset($company->is_featured) && $company->is_featured)
                                    {{-- <span class="featured-badge">FEATURED</span> --}}
                                @endif

                                <div class="company-logo-wrap">
                                    <img src="{{ $company->logo_url ?? asset('modules/themes/default/images/default_company_logo.png') }}"
                                        class="company-logo-img" alt="{{ $company->name ?? 'Company Name' }}">
                                </div>

                                <div class="company-info">
                                    <h6 class="" title="{{ $company->name ?? 'Company Name' }}">
                                        {{ $company->name ?? 'Company Name Placeholder' }}
                                    </h6>

                                    {{-- Location --}}
                                    <div class="company-meta-item">
                                        <i class="pe-7s-map-marker"></i>
                                        {{ $company->location ?? 'Dhaka, Bangladesh' }}
                                    </div>

                                    {{-- Category --}}
                                    <div class="company-meta-item">
                                        <i class="pe-7s-folder"></i>
                                        {{ $company->category ?? 'IT & Telecom' }}
                                    </div>

                                    {{-- Open Jobs Count --}}
                                    <div class="company-meta-item">
                                        <i class="pe-7s-airplay"></i>
                                        <span
                                            class="font-weight-bold text-success">{{ $company->open_jobs_count ?? '12' }}</span>
                                        Open Jobs
                                    </div>
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
@stop

@push('scripts')
    <script type="text/javascript">
        var url_search_home_page = "{{ route('jobslist', ['q' => ':q']) }}";
    </script>
@endpush
