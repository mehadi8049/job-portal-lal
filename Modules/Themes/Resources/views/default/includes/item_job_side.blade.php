<div class="item-job">
  <article>
      <div class="item-job-list">
          <div class="item-job-half">
              <div class="item-flex-box">
                  <div class="item-job-img">
                      <a href="{{ route('company', ['slug' => $job->company->slug]) }}"><img src="{{ $job->company->getLogoLink() }}" class="img-responsive" alt="{{ $job->company->company_name }}"></a>
                  </div>

                  <div class="item-job-pos">
                      <h3 class="jb-title"><a href="{{ route('job', ['slug' => $job->slug]) }}">{{ $job->title }}</a></h3>
                      
                      <p>
                          <span class="item-job-type">{{ $job->job_type->name }}</span>
                          @if ($job->is_featured)
                          <span class="featured-text" data-toggle="tooltip" title="" data-original-title="featured">@lang('Featured')</span>
                          @endif
                      </p>
                     <div class="job-metas">
                          <div class="category-job">
                              <div class="job-category with-icon">
                                  <i class="pe-7s-id"></i>
                                  <a href="{{ route('jobslist', ['functionalarea' => $job->functional_area->id]) }}" style="">{{ $job->functional_area->name }}</a>
                              </div>
                          </div>
                          @if(isset($job->city))
                          <div class="job-location">
                              <i class="pe-7s-map-marker"></i>
                              <a href="{{ route('jobslist', ['city' => $job->city->id]) }}">{{ $job->city->name }}</a>
                          </div>
                          @endif
                          <div class="job-deadline"><i class="pe-7s-date"></i> {{ \Carbon\Carbon::parse($job->created_at)->toFormattedDateString() }}</div>
                          @isset($job->salary_from, $job->salary_to)
                          <div class="job-salary"><i class="pe-7s-cash"></i> <span class="price-text">{{ $job->salary_from }} <span class="suffix">{{$job->salary_currency}}</span> - <span class="price-text">{{ $job->salary_to }} <span class="suffix">{{$job->salary_currency}}</span></span>
                          </div>
                          @endisset
                      </div>
                  </div>

              </div>
          </div>
         
      </div>
  </article>
</div>