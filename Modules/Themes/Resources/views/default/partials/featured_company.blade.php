<style>
    /* 1. Centering & Layout */
    .job-section-wrapper {
        max-width: 1200px;
        /* Max width to center the grid */
        margin: 40px auto;
        padding: 0 15px;
    }

    /* 1. Base Grid (Mobile: 1 Column) */
    .job-grid {
        display: grid;
        grid-template-columns: 1fr;
        border-top: 1px solid #e0e0e0;
        border-left: 1px solid #e0e0e0;
        background-color: #fff;
    }

    /* 2. Tablet: 2 Columns */
    @media (min-width: 640px) {
        .job-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* 3. PC/Desktop: 4 Columns */
    @media (min-width: 1024px) {
        .job-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Logic for "Hidden on Static" */
    .hidden-on-static {
        display: none;
        /* Hide extra jobs by default */
    }

    .job-card-wrapper:hover .hidden-on-static {
        display: block;
        /* Show extra jobs on hover */
    }

    .job-card-wrapper:hover .static-only {
        display: none;
        /* Hide the "..." indicator on hover */
    }

    /* 4. Responsive Card Container */
    .job-card-wrapper {
        position: relative;
        height: 115px;
        border-right: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
    }

    /* 3. Smooth Expanding Content */
    .job-card-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 12px;
        background: #fff;
        z-index: 10;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        /* Ultra smooth animation */
        display: flex;
        gap: 12px;
    }

    /* Hover State */
    .job-card-wrapper:hover .job-card-content {
        height: auto;
        min-height: 100%;
        z-index: 100;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid #2563eb;
        margin: -1px;
        /* Aligns border over the grid */
    }

    /* 4. Logo Box Design */
    .logo-box {
        width: 65px;
        height: 65px;
        flex-shrink: 0;
        border: 1px solid #f0f0f0;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }

    .logo-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* 5. Typography */
    .comp-name {
        font-size: 13.5px;
        color: #1a56db;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .comp-name:hover {
        text-decoration: underline;
    }

    .cat-item {
        font-size: 12px;
        color: #555;
        display: block;
        padding: 2px 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cat-item:hover {
        color: #2563eb;
    }

    .cat-icon {
        font-size: 9px;
        margin-right: 6px;
        color: #888;
    }

    .more-indicator {
        font-size: 11px;
        color: #999;
        margin-top: 2px;
    }
</style>

<div class="job-section-wrapper">
    <h1>Hot Jobs
    </h1>
    <div class="job-grid">
        @foreach ($companies as $company)
            <div class="job-card-wrapper">
                <div class="job-card-content">
                    <div class="logo-box">
                        <img src="{{ $company->getLogoLink() }}" alt="{{ $company->company_name ?? 'Company Name' }}">
                    </div>

                    <div class="flex-1 overflow-hidden">
                        <h3 class="comp-name" title="{{ $company->company_name ?? 'Company Name' }}">
                            {{ $company->company_name ?? 'Company Name' }}
                        </h3>

                        <div class="category-list">
                            @foreach ($company->jobs as $index => $job)
                                <a href="{{ route('job', $job->slug) }}"
                                    class="cat-item {{ $index >= 2 ? 'hidden-on-static' : '' }}">
                                    <span class="cat-icon">▶</span>{{ $job?->title }}
                                </a>
                            @endforeach
                            @if ($company->jobs?->count() > 2)
                                <div class="more-indicator static-only">...</div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Pure CSS is used for the animation to keep it smooth, 
    // but you can add Alpine.js here if you need complex toggle logic.
</script>
