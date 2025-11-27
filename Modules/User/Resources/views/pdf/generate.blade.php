<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CV of {{ $user->name }}</title>
    <style>
        @page {
            margin: 20mm 15mm;
        }

        /* First page top margin */
        @page :first {
            margin-top: 0;
            margin-bottom: 0;
        }

        header {
            position: fixed;
            top: -10mm;
            left: 0;
            right: 0;
            height: 20mm;
            text-align: center;
            font-size: 12px;
            border-bottom: 1px solid #000;
        }

        footer {
            position: fixed;
            bottom: -10mm;
            left: 0;
            right: 0;
            height: 20mm;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #000;
        }

        .content {
            margin-top: 30mm;
            margin-bottom: 30mm;
        }

        .header-left h1 {
            font-size: 24px;
            color: rgb(0, 51, 102);
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header-left p {
            font-size: 12px;
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .contact-info {
            font-size: 12px;
            margin-top: 10px;
        }

        .contact-info a {
            color: rgb(0, 0, 255);
            text-decoration-line: underline;
            text-decoration-thickness: initial;
            text-decoration-style: initial;
            text-decoration-color: initial;
        }

        .profile-photo {
            width: 120px;
            height: 130px;
            border-top-width: 2px;
            border-right-width: 2px;
            border-bottom-width: 2px;
            border-left-width: 2px;
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-color: rgb(0, 0, 0);
            border-right-color: rgb(0, 0, 0);
            border-bottom-color: rgb(0, 0, 0);
            border-left-color: rgb(0, 0, 0);
            border-image-source: initial;
            border-image-slice: initial;
            border-image-width: initial;
            border-image-outset: initial;
            border-image-repeat: initial;
            object-fit: cover;
            top: 2px;
            right: 0;
            position: absolute;
        }

        .section-header {
            background-color: rgb(224, 224, 224);
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-color: rgb(0, 0, 0);
            border-right-color: rgb(0, 0, 0);
            border-bottom-color: rgb(0, 0, 0);
            border-left-color: rgb(0, 0, 0);
            border-image-source: initial;
            border-image-slice: initial;
            border-image-width: initial;
            border-image-outset: initial;
            border-image-repeat: initial;
            padding-top: 8px;
            padding-right: 8px;
            padding-bottom: 8px;
            padding-left: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            margin-right: 0px;
            margin-bottom: 10px;
            margin-left: 0px;
        }

        .section-content {
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-color: rgb(0, 0, 0);
            border-right-color: rgb(0, 0, 0);
            border-bottom-color: rgb(0, 0, 0);
            border-left-color: rgb(0, 0, 0);
            border-image-source: initial;
            border-image-slice: initial;
            border-image-width: initial;
            border-image-outset: initial;
            border-image-repeat: initial;
            padding-top: 12px;
            padding-right: 12px;
            padding-bottom: 12px;
            padding-left: 12px;
            margin-bottom: 10px;
            font-size: 12px;
            line-height: 1.6;
        }

        .section-content p {
            margin-bottom: 8px;
        }

        .employment-entry {
            margin-bottom: 15px;
        }

        .job-title {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .company-info {
            margin-bottom: 3px;
        }

        .job-description {
            margin-top: 5px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
            font-size: 11px;
        }

        th {
            background-color: rgb(224, 224, 224);
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-color: rgb(0, 0, 0);
            border-right-color: rgb(0, 0, 0);
            border-bottom-color: rgb(0, 0, 0);
            border-left-color: rgb(0, 0, 0);
            border-image-source: initial;
            border-image-slice: initial;
            border-image-width: initial;
            border-image-outset: initial;
            border-image-repeat: initial;
            padding-top: 8px;
            padding-right: 4px;
            padding-bottom: 8px;
            padding-left: 4px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }

        td {
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-color: rgb(0, 0, 0);
            border-right-color: rgb(0, 0, 0);
            border-bottom-color: rgb(0, 0, 0);
            border-left-color: rgb(0, 0, 0);
            border-image-source: initial;
            border-image-slice: initial;
            border-image-width: initial;
            border-image-outset: initial;
            border-image-repeat: initial;
            padding-top: 6px;
            padding-right: 4px;
            padding-bottom: 6px;
            padding-left: 4px;
            vertical-align: top;
        }

        tr:nth-child(2n) {
            background-color: rgb(249, 249, 249);
        }

        .table-header {
            background-color: rgb(224, 224, 224);
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-color: rgb(0, 0, 0);
            border-right-color: rgb(0, 0, 0);
            border-bottom-color: rgb(0, 0, 0);
            border-left-color: rgb(0, 0, 0);
            border-image-source: initial;
            border-image-slice: initial;
            border-image-width: initial;
            border-image-outset: initial;
            border-image-repeat: initial;
            padding-top: 8px;
            padding-right: 8px;
            padding-bottom: 8px;
            padding-left: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            margin-right: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
        }

        .table-wrapper {
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px;
            border-left-width: 1px;
            border-top-style: solid;
            border-right-style: solid;
            border-bottom-style: solid;
            border-left-style: solid;
            border-top-color: rgb(0, 0, 0);
            border-right-color: rgb(0, 0, 0);
            border-bottom-color: rgb(0, 0, 0);
            border-left-color: rgb(0, 0, 0);
            border-image-source: initial;
            border-image-slice: initial;
            border-image-width: initial;
            border-image-outset: initial;
            border-image-repeat: initial;
            margin-bottom: 10px;
        }

        .footer {
            text-align: right;
            margin-top: 40px;
            padding-top: 20px;
            border-top-width: 1px;
            border-top-style: solid;
            border-top-color: rgb(0, 0, 0);
            font-size: 12px;
        }

        .signature-line {
            margin-top: 50px;
            margin-bottom: 5px;
        }

        @media print {
            body {
                background-color: rgb(255, 255, 255);
                padding-top: 0px;
                padding-right: 0px;
                padding-bottom: 0px;
                padding-left: 0px;
            }

            .container {
                box-shadow: none;
                padding-top: 20px;
                padding-right: 20px;
                padding-bottom: 20px;
                padding-left: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container"><!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->present_address }}</p>
                <div class="contact-info">
                    <p>{{ $user->primary_mobile }},<br /><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                </div>
            </div><img src="{{ public_path('storage/user_storage/' . $user->id . '/' . $user->photo) }}"
                alt="Profile Photo" class="profile-photo" />
        </div><!-- Career Objective -->
        <div class="section-header">Career Objective</div>
        <div class="section-content">
            <p>{{ $user->objective }}</p>
        </div><!-- Career Summary -->
        @if ($user->career_summary)
            <div class="section-header">Career Summary</div>
            <div class="section-content">
                {{ $user->career_summary }}
            </div>
        @endif
        <div class="section-header">Employment History</div>
        <div class="section-content">
            @foreach ($user->experiences as $experience)
                <div class="employment-entry">
                    <div class="job-title">{{ $experience->designation }}
                        ({{ $experience->employment_from?->format('Y-m-d') }} -
                        {{ $experience->is_current ? 'Present' : $experience->employment_to?->format('Y-m-d') }})
                    </div>
                    <div class="company-info"><strong>{{ $experience->company_name }}</strong></div>
                    <div class="company-info">{{ $experience->company_location }}</div>
                    <div class="job-description">Tech Stack: {{ implode(',', $experience->area_of_expertise) }}
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
                            <td>{{ $qualification->education_level }}</td>
                            <td>{{ $qualification->institute_name }}</td>
                            <td>{{ $qualification->major }}</td>
                            <td>{{ $qualification->passing_year }}</td>
                            <td>{{ $qualification->duration_years }}</td>
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
                            <td>{{ $lang_pro->language_name }}</td>
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
                        <td>{{ $user->fother_name }}</td>
                        <td id="imxi66"><strong>Date of Birth</strong></td>
                        <td id="ijv0i5">{{ $user->date_of_birth }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mother's Name</strong></td>
                        <td>{{ $user->mother_name }}</td>
                        <td id="ix2sns"><strong>Religion</strong></td>
                        <td id="i9h75g">{{ $user->religion }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nationality</strong></td>
                        <td>{{ $user->nationality }}</td>
                        <td id="ia2lci"><strong>Marital Status</strong></td>
                        <td id="ipf78j">{{ $user->marital_status }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Present Address:</strong> {{ $user->present_address }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Permanent Address:</strong> {{ $user->parmanent_address }}</td>
                    </tr>
                </tbody>
            </table>
        </div><!-- Footer -->
        <div class="footer">
            <p>I hereby confirm that the information above is provided for demo purposes only.</p>
            <div class="signature-line">Sincerely Yours,</div>
            <div id="i1i5mf">________________________</div>
            <p>{{ $user->name }}</p>
            <p>Date: {{ now()->format('Y-m-d') }}</p>
        </div>
    </div>

</body>

</html>
