<article >
    <div class="employer-item">
        <div class="employer-img">
            <a href="{{ route('company', ['slug' => $company->slug]) }}">
                <img width="100" height="100" src="{{ $company->getLogoLink() }}" class="" alt="{{ $company->company_name }}"> </a>
        </div>
        <h2 class="employer-title"><a href="{{ route('company', ['slug' => $company->slug]) }}">{{ $company->company_name }}</a></h2>
        <div class="employer-information">
            @if(isset($company->city))
            <div class="employer-location">
                <div class="value">
                    <i class="pe-7s-map-marker"></i>
                    <a href="{{ route('companies', ['city' => $company->city->id]) }}">{{ $company->city->name }}</a>
                </div>
            </div>
            @endif
            @if(isset($company->industry))
            <div class="job-category">
                <div class="value">
                    <i class="pe-7s-id"></i>
                    <a class="employer-category" href="{{ route('companies', ['industry' => $company->industry->id]) }}">{{ $company->industry->name }}</a>
                </div>
            </div>
            @endif
            <div class="open-job">
                <span>@lang('Open Jobs') - {{ $company->jobs()->count() }}</span> 
            </div>
            @if ($company->is_featured)
            <div class="mt-1">
                <span class="featured-text">@lang('Featured')</span>
            </div>
            @endif
        </div>
    </div>
</article>