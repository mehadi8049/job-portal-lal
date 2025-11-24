<div class="container"><!-- Header -->
    <div class="header">
        <div class="header-left">
            <h1>{{$user->name}}</h1>
            <p>{{$user->present_address}}</p>
            <div class="contact-info">
                <p>{{$user->primary_mobile}},<br /><a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
            </div>
        </div><img src="{{ URL::to('/') }}/storage/user_storage/{{ $user->id. "/". $user->photo }}" alt="Profile Photo" class="profile-photo" />
    </div><!-- Career Objective -->
    <div class="section-header">Career Objective</div>
    <div class="section-content">
        <p>{{$user->objective}}</p>
    </div><!-- Career Summary -->
    @if($user->career_summary)
    <div class="section-header">Career Summary</div>
    <div class="section-content">
        {{$user->career_summary}}
    </div>
    @endif
    <div class="section-header">Employment History</div>
    <div class="section-content">
        @foreach ($user->experiences as $experience)
        <div class="employment-entry">
            <div class="job-title">{{ $experience->designation }} ({{ $experience->employment_from->format('Y-m-d') }} -
                                {{ $experience->is_current ? 'Present' : $experience->employment_to->format('Y-m-d') }})</div>
            <div class="company-info"><strong>{{ $experience->company_name }}</strong></div>
            <div class="company-info">{{ $experience->company_location }}</div>
            <div class="job-description">Tech Stack: {{implode(',', $experience->area_of_expertise)}}
            </div>
        </div>
        @endforeach
    </div><!-- Academic Qualification -->
    <div class="table-header">Academic Qualification</div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Exam Title</th>
                    <th>Institute/Board/University</th>
                    <th>Subject/Group/Discipline</th>
                    <th>Passing Year</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->qualifications as $qualification)
                <tr>
                    <td>{{$qualification->education_level}}</td>
                    <td>{{$qualification->institute_name}}</td>
                    <td>{{$qualification->major}}</td>
                    <td>{{$qualification->passing_year}}</td>
                    <td>{{$qualification->duration_years}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- Training Summary -->
    {{-- <div class="table-header">Training Summary</div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Training Title</th>
                    <th>Institute/Organization</th>
                    <th>Training Area</th>
                    <th>Duration</th>
                    <th>Location</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Laravel Advanced Development</td>
                    <td>CodeLab Academy</td>
                    <td>Web Development</td>
                    <td>3 months</td>
                    <td>Sample City</td>
                    <td>2020</td>
                </tr>
                <tr>
                    <td>React.js Professional Bootcamp</td>
                    <td>WebDev Institute</td>
                    <td>Frontend Development</td>
                    <td>2 months</td>
                    <td>Online</td>
                    <td>2021</td>
                </tr>
            </tbody>
        </table>
    </div><!-- Professional Qualification -->
    <div class="table-header">Professional Qualification</div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Certification</th>
                    <th>Issuing Organization</th>
                    <th>Date of Issued</th>
                    <th>Status</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Full Stack Web Development Certification</td>
                    <td>Coursera</td>
                    <td>March 10, 2022</td>
                    <td>Active</td>
                    <td>2022</td>
                </tr>
            </tbody>
        </table>
    </div><!-- Language Proficiency --> --}}
    <div class="table-header">Language Proficiency</div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Language</th>
                    <th>Reading</th>
                    <th>Writing</th>
                    <th>Speaking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->languageProficiencies as $lang_pro)
                <tr>
                    <td>{{$lang_pro->language_name}}</td>
                    <td>{{ $lang_pro->reading_level }}</td>
                    <td>{{ $lang_pro->writing_level }}</td>
                    <td>{{ $lang_pro->speaking_level }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- Personal Details -->
    <div class="table-header">Personal Details</div>
    <div class="table-wrapper">
        <table>
            <tbody>
                <tr>
                    <td><strong>Father's Name</strong></td>
                    <td>{{$user->fother_name}}</td>
                    <td id="imxi66"><strong>Date of Birth</strong></td>
                    <td id="ijv0i5">{{$user->date_of_birth}}</td>
                </tr>
                <tr>
                    <td><strong>Mother's Name</strong></td>
                    <td>{{$user->mother_name}}</td>
                    <td id="ix2sns"><strong>Religion</strong></td>
                    <td id="i9h75g">{{$user->religion}}</td>
                </tr>
                <tr>
                    <td><strong>Nationality</strong></td>
                    <td>{{$user->nationality}}</td>
                    <td id="ia2lci"><strong>Marital Status</strong></td>
                    <td id="ipf78j">{{$user->marital_status}}</td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Present Address:</strong> {{$user->present_address}}</td>
                </tr>
                <tr>
                    <td colspan="4"><strong>Permanent Address:</strong> {{$user->parmanent_address}}</td>
                </tr>
            </tbody>
        </table>
    </div><!-- Footer -->
    <div class="footer">
        <p>I hereby confirm that the information above is provided for demo purposes only.</p>
        <div class="signature-line">Sincerely Yours,</div>
        <div id="i1i5mf">________________________</div>
        <p>{{$user->name}}</p>
        <p>Date: {{now()->format('Y-m-d')}}</p>
    </div>
</div>
