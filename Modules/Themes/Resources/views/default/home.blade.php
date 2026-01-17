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
            background: #083344;
            background-position: center center;
            position: relative;
        }

        .bg-overlay {
            background-color: rgba(255, 255, 255, 0.1);
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
            color: #ffffff;
            font-weight: 700;
        }

        .hero-subtitle {
            color: #ffffff;
        }

        /* Stats Circle */
        .stat-circle {
            width: 50px;
            height: 50px;
            background: #ed7724;
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
            color: #ffffff;
            margin: 0;
        }

        .stat-text p {
            color: #e6e6e6;
            margin: 0;
            font-size: 12px;
            text-transform: uppercase;
        }

        /* Main Search Box (Desktop/Complex) */
        .bd-search-box {
            background: #ed7724cf;
            padding: 15px;
            margin-bottom: 1rem !important;
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
            background-color: #3360ad;
            color: #fff;
            font-weight: 600;
            padding: 0 30px;
            border: none;
            height: 45px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* --- Mobile Search Box Styles (New) --- */
        .mobile-search-form .form-control,
        .mobile-search-form select {
            border: 1px solid #fff !important;
            height: 45px !important;
            border-radius: 4px !important;
        }

        .mobile-search-form .form-group {
            margin-bottom: 15px;
        }

        .mobile-search-form .btn-primary {
            width: 100%;
            background-color: #3360ad !important;
            border-color: #3360ad !important;
            padding: 10px !important;
            font-weight: 600;
        }

        /* --- Quick Links Sidebar --- */
        .quick-links-box {
            background-color: #2457959c;
            color: #fff;
            padding: 20px;
            height: 100%;
            height: 100%;
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
            color: #000;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 3px;
            font-weight: 700;
            margin-left: 5px;
            text-transform: lowercase;
            vertical-align: middle;
        }

        /* --- Category Section & Sidebar CSS --- */
        .cat-section {
            border: 1px solid #e1e7ec;
            padding: 20px 15px;
        }

        .cat-section-buttons a {
            width: 135px;
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
            padding: 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
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
        }

        .company-item-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #00b074;
            transform: translateY(100%);
            transition: transform 0.3s ease-out;
        }

        .company-item-card:hover::after {
            transform: translateY(0);
        }

        .company-logo-img {
            height: 45px;
            object-fit: cover;
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
            color: white;
            font-size: 10px;
            padding: 3px 8px;
            border-top-right-radius: 7px;
            border-bottom-left-radius: 7px;
            font-weight: 700;
        }




        /* Default styling for the location buttons */
        .btn-primary {
            background-color: #0057b394 !important;
            border-color: #0057b312 !important;
            padding: 4px 10px;
            margin: 2px;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #004494 !important;
            border-color: #004494 !important;
        }

        .card-padding {
            padding: 0px 8px !important;
        }

        .btn-yellow {
            background-color: #ff9800 !important;
            border-color: #ff9800 !important;
            color: #fff !important;
            padding: 4px 10px;
            margin: 2px;
            border-radius: 4px;
            font-size: 14px;
        }


        /* cv builder */

        :root {
            --step-blue: #0062af;
            --step-orange: #f39c12;
            --step-coral: #e67e22;
            --step-teal: #16a085;
            --step-dark: #2c3e50;
        }

        .process-section {
            padding: 40px 0;
            background: #f8f9fa;
        }

        /* Header Styling */
        .cv-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .cv-header h2 {
            font-weight: 900;
            font-size: 2.2rem;
            color: #333;
        }

        .cv-header h2 i {
            color: var(--step-blue);
            margin-right: 10px;
        }

        /* The Process Container */
        .process-container {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
        }

        /* Individual Card */
        .step-card {
            position: relative;
            flex: 1;
            padding: 35px 20px;
            color: white;
            text-align: center;
            background-color: #333;
            /* This creates the overlap effect */
            clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%, 5% 50%);
            margin-right: -15px;
            /* Pulls cards together */
            transition: all 0.3s ease;
        }

        /* First and Last Card rounding/adjustments */
        .step-card:first-child {
            clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%);
            border-radius: 8px 0 0 8px;
        }

        .step-card:last-child {
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%, 5% 50%);
            border-radius: 0 8px 8px 0;
            margin-right: 0;
        }

        .step-card:hover {
            transform: scale(1.05);
            z-index: 10;
            filter: brightness(1.1);
        }

        .step-card h4 {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .step-card p {
            font-size: 0.75rem;
            line-height: 1.4;
            opacity: 0.9;
            margin-bottom: 0;
            padding: 0 10px;
        }

        .step-card i {
            font-size: 32px;
            margin-bottom: 12px;
            display: block;
        }

        /* Specific Colors */
        .bg-1 {
            background-color: var(--step-blue);
        }

        .bg-2 {
            background-color: var(--step-orange);
        }

        .bg-3 {
            background-color: var(--step-coral);
        }

        .bg-4 {
            background-color: var(--step-teal);
        }

        .bg-5 {
            background-color: var(--step-dark);
        }

        /* Modern Button */
        .btn-build {
            background: var(--step-blue);
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
            box-shadow: 0 8px 20px rgba(0, 98, 175, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-build:hover {
            background: #004a85;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 98, 175, 0.4);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .process-container {
                flex-direction: column;
            }

            .step-card {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
                clip-path: none !important;
                border-radius: 12px !important;
            }
        }
    </style>
@endpush

@section('content')


    @include('themes::default.partials.hero')
    @include('themes::default.partials.location')
    @include('themes::default.partials.category')
    @include('themes::default.partials.featured_company')
    @include('themes::default.partials.cv_builder')
    @include('themes::default.partials.resume')
@stop

@push('scripts')
    <script type="text/javascript">
        var url_search_home_page = "{{ route('jobslist', ['q' => ':q']) }}";
    </script>
@endpush
