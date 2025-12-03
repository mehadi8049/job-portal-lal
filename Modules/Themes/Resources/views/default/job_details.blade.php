@extends('themes::default.layout')
@section('content')
<div class="job-header bg-light">
    <div class="container">
        <div class="clearfix">
            <div class="company-img">
                <a href="{{ route('company', ['slug' => $job->company->slug]) }}">
                    <img width="100" height="100" src="{{ $job->company->getLogoLink() }}" alt="{{ $job->company->company_name }}"> 
                </a>
            </div>
            <div class="job-info-detail">
                <div class="title-wrapper">
                    <h1 class="job-title">{{ $job->title }}</h1>
                </div>
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
                <div class="job-metas-bottom">
                    <div class="job-type title-box">
                        <h6 class="title-sub-title mb-0 text-primary">{{ $job->job_type->name }}</h6>
                        @if ($job->is_featured)
                        <h6 class="title-sub-title job-featured">@lang('Featured')</h6>
                        @endif
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="job-buttons">
            <div class="action">
                @isset($job->expiry_date)
                <div class="deadline">@lang('Application ends'): <strong>{{ \Carbon\Carbon::parse($job->expiry_date)->toFormattedDateString() }}</strong></div>
                @endisset
                <a href="#" data-toggle="modal" data-target="#applyModal" class="btn btn-primary">@lang('Apply Now')</a>
                <a href="{{url('templates')}}" class="btn btn-warning">@lang('Make CV')</a>
            </div>
        </div>
        <div class="social-job-detail">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('job',$job->slug )}}" target="_blank"><i class="mdi mdi-facebook"></i></a>
            <a href="https://twitter.com/share?url={{ route('job',$job->slug )}}" target="_blank"><i class="mdi mdi-twitter"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('job',$job->slug )}}" target="_blank"><i class="mdi mdi-linkedin"></i></a>
        </div>
    </div>
</div>
<div class="job-content container">
    <div class="job-content-detail">
        <!-- Main content -->
        <div class="list-job">

            <!-- overview -->
            <div class="job-detail-more">
                <h3 class="title">@lang('Job Overview')</h3>
                <ul class="list">
                    <li>
                        <div class="icon">
                            <i class="pe-7s-date"></i>
                        </div>
                        <div class="details">
                            <div class="text">@lang('Date Posted')</div>
                            <div class="value">{{ \Carbon\Carbon::parse($job->created_at)->toFormattedDateString() }}</div>
                        </div>
                    </li>

                    <li>
                        <div class="icon">
                            <i class="pe-7s-map-marker"></i>
                        </div>
                        @if(isset($job->city))
                        <div class="details">
                            <div class="text">@lang('Location')</div>
                            <div class="value">
                                <div class="">
                                    <a href="{{ route('jobslist', ['city' => $job->city->id]) }}">{{ $job->city->name }}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </li>

                    <li>
                        <div class="icon">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="details">
                            <div class="text">@lang('Offered Salary')</div>
                            <div class="job-salary value"><i class="pe-7s-cash"></i> 
                                <span class="price-text">{{ $job->salary_from }} <span class="suffix">{{$job->salary_currency}}</span> - <span class="price-text">{{ $job->salary_to }} <span class="suffix">{{$job->salary_currency}}</span></span> / {{$job->job_salary_period->name}}
                            </div>

                        </div>
                    </li>

                    <li>
                        <div class="icon">
                            <i class="pe-7s-date"></i>
                        </div>
                        <div class="details">
                            <div class="text">@lang('Expiration date')</div>
                            <div class="value">{{ \Carbon\Carbon::parse($job->expiry_date)->toFormattedDateString() }}</div>
                        </div>
                    </li>

                    @isset($job->job_experience)
                    <li>
                        <div class="icon">
                            <i class="pe-7s-user"></i>
                        </div>
                        <div class="details">
                            <div class="text">@lang('Experience')</div>
                            <div class="value">
                                {{ $job->job_experience->name }}
                            </div>
                        </div>
                    </li>
                    @endisset

                    @isset($job->gender)
                    <li>
                        <div class="icon">
                            <i class="pe-7s-user-female"></i>
                        </div>
                        <div class="details">
                            <div class="text">@lang('Gender')</div>
                            <div class="value">
                                {{ $job->gender->name }}
                            </div>
                        </div>
                    </li>
                    @endisset

                    @isset($job->degree_level)
                    <li>
                        <div class="icon">
                            <i class="pe-7s-wristwatch"></i>
                        </div>
                        <div class="details">
                            <div class="text">@lang('Qualification')</div>
                            <div class="value">{{ $job->degree_level->name }}</div>
                        </div>
                    </li>
                    @endisset

                    @isset($job->career_level)
                    <li>
                        <div class="icon">
                            <i class="pe-7s-id"></i>
                        </div>
                        <div class="details">
                            <div class="text">@lang('Career Level')</div>
                            <div class="value">{{ $job->career_level->name }}</div>
                        </div>
                    </li>
                    @endisset
                </ul>
            </div>
            <!-- job description -->
            <div class="job-detail-description">
                <h3 class="title">@lang('Job Description')</h3>
                <div>
                    {!! $job->description !!}
                </div>
                <h3 class="title">@lang('Key Responsibilities')</h3>
                {!! $job->responbilities !!}
                <h3 class="title">@lang('Skills, Experiences')</h3>
                {!! $job->requirements !!}

            </div>

            <!-- job releated -->
            <div class="releated-jobs">
                <h3 class="title">@lang('Related Jobs')</h3>
                <div class="row">
                    <div class="col-md-12">
                        @foreach($siblings as $item)
                            @include('themes::default.includes.item_job_side', ['job' => $item])
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Apply')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="" action="{{ route('company.apply') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    @php 
                        $tmp_user = \Auth::getUser();
                    @endphp
                    <input type="hidden" name="job_id" value="{{ $job->id }}" />
                    <input type="hidden" name="company_id" value="{{ $job->company_id }}" />
                    <div class="form-group">
                        <label class="col-form-label">@lang('Full name'):</label>
                        <input type="text" class="form-control" placeholder="" name="fullname" value="{{ old('fullname', isset($tmp_user) ? $tmp_user->name : '' ) }}" required />
                        @error('fullname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">@lang('Email'):</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', isset($tmp_user) ? $tmp_user->email : '' ) }}" required />
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">@lang('Description'):</label>
                        <textarea class="form-control" placeholder="@lang('Description for employer')" name="description" rows="3">{{ old('description', '' ) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">@lang('ResumeCV Link'):</label>
                        <input type="text" class="form-control" placeholder="@lang('Your resume link public')" name="resume_link" value="{{ old('resume_link', '') }}" />
                        <small><a href="{{route('templates')}}" class="text-info">@lang("If you don't have a resume you can create one for FREE here").</a></small>
                        @error('resume_link')
                            <br><small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">@lang('Or ResumeCV PDF'):</label>
                        <input name="resume_pdf" class="form-control" type="file" accept="application/pdf" />
                        @error('resume_pdf')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary btn-sm">@lang('Apply')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@push('scripts')
@if($errors->has('fullname') || $errors->has('email') || $errors->has('description') || $errors->has('resume_link') || $errors->has('resume_pdf'))
<script>
    $('#applyModal').modal();
</script>
@endif
@endpush