<div class="cv-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile-header">
            <div class="profile-photo">
                <img src="/placeholder.svg?height=120&width=120" alt="Profile photo" />
            </div>
            <h1 class="profile-name">{{ $user->name }}</h1>
            <p class="profile-title">{{ $user->email }}</p>
        </div>

        <div class="sidebar-section">
            <h3 class="section-title">Contact</h3>
            <ul>
                <li><strong>Phone</strong>
                    <a href="tel:+1234567890" class="contact-link">{{ $user->primary_mobile }}</a>
                </li>
                <li><strong>Email</strong>
                    <a href="mailto:{{ $user->email }}" class="contact-link">{{ $user->email }}</a>
                </li>
                <li><strong>Location</strong>
                    {{ $user->present_address }}
                </li>
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="section-title">Core Skills</h3>
            <ul>
                @foreach ($user->skills as $skill)
                    <li>
                        <span class="skill-tag">{{ $skill->skill_name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="section-title">Languages</h3>
            <ul>
                @foreach ($user->languageProficiencies as $lang_pro)
                    <li>{{ $lang_pro->language_name }} – {{ $lang_pro->speaking_level }}</li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar-section">
            <h3 class="section-title">Certifications</h3>
            <ul>
                @foreach ($user->qualifications as $qualification)
                    <li>{{ $qualification->education_level }}</li>
                @endforeach
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <section class="header-intro">
            <p class="intro-text">
                A highly motivated Full Stack Developer with experience designing, developing, and delivering scalable
                web applications. Skilled in both frontend and backend technologies with a strong passion for clean
                architecture and problem-solving.
            </p>
        </section>

        <section class="content-section">
            <h2 class="content-section-title">Professional Experience</h2>
            <div class="section-content">
                @foreach ($user->experiences as $experience)
                    <article class="entry">
                        <div class="entry-header">
                            <h3 class="entry-title">{{ $experience->designation }}</h3>
                            <span class="entry-date">{{ $experience->employment_from->format('Y-m-d') }} -
                                {{ $experience->is_current ? 'Present' : $experience->employment_to->format('Y-m-d') }}</span>
                        </div>
                        <p class="entry-company">{{ $experience->company_name }}</p>
                        <p class="entry-description">
                            {{ $experience->responsibilities }}
                        </p>
                        <p class="entry-details"><strong>Location:</strong> {{ $experience->company_location }}</p>
                        <div class="tech-skills">
                            @foreach ($experience->area_of_expertise as $value)
                                <span class="tech-tag">{{ $value }}</span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="content-section">
            <h2 class="content-section-title">Education</h2>
            <div class="section-content">
                @foreach ($user->qualifications as $qualification)
                    <article class="entry">
                        <div class="entry-header">
                            <h3 class="entry-title">{{$qualification->education_level}}</h3>
                            <span class="entry-date">{{$qualification->passing_year}}</span>
                        </div>
                        <p class="entry-company">{{$qualification->degree_title}}</p>
                        <p class="entry-details"><strong>Institution:</strong> {{$qualification->institute_name}}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
</div>
