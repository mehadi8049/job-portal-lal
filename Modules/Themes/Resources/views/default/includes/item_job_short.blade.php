<div class="item-job">
    <article>
        <div class="item-job-list bottom-hover">
            <div class="item-job-half">
                <div class="item-flex-box">
                    <div class="item-job-img">
                    <a href="{{ route('company', ['slug' => $job->company->slug]) }}"><img src="{{ $job->company->getLogoLink() }}" class="img-responsive" alt="{{ $job->company->company_name }}"></a>
                    </div>
                    <div class="item-job-pos">
                      <h3 class="jb-title"><a href="{{ route('job', ['slug' => $job->slug]) }}">{{ $job->title }}</a></h3>
                      <p>
                          <a href="{{ route('jobslist', ['functionalarea' => $job->functional_area->id]) }}">{{ $job->functional_area->name }}</a>
                          <span class="item-job-type">{{ $job->job_type->name }}</span>
                      </p>
                      @if(isset($job->city))
                      <div class="job-location"><i class="pe-7s-map-marker"></i>{{ $job->city->name }}</div>
                      @endif
                  </div>
                </div>
            </div>
        </div>
    </article>
</div>