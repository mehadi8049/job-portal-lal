<div class="cv-container">
    <!-- HEADER -->
    <header class="header">
        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
            alt="{{ $user->name }}" class="profile-img" />
        <div class="header-text">
            <h1>{{ $user->name }}</h1>
            <div class="subtitle">{{ $user->email }}</div>
            <div class="subtitle">{{ $user->primary_mobile }}</div>
            <p>{{ $user->present_address }}</p>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- Profile -->
        <section class="section">
            <h2 class="section-title">
                <i class="fa-solid fa-user"></i> Professional Profile
            </h2>
            <p class="profile-text">
                {{ $user->objective }}
            </p>
        </section>

        <!-- Work Experience -->
        <section class="section timeline-section">
            <h2 class="section-title">
                <i class="fa-solid fa-briefcase"></i> Work Experience
            </h2>
            @foreach ($user->experiences as $experience)
                <div class="exp-item">
                    <div class="exp-header">
                        <span class="exp-title">{{ $experience->designation }}</span>
                        <span class="exp-date">{{ $experience->employment_from->format('Y-m-d') }} -
                            {{ $experience->is_current ? 'Present' : $experience->employment_to->format('Y-m-d') }}</span>
                    </div>
                    <div class="exp-company">{{ $experience->company_location }}</div>
                    <ul>
                        @foreach ($experience->area_of_expertise as $value)
                            <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </section>

        <!-- Education -->
        <section class="section timeline-section">
            <h2 class="section-title">
                <i class="fa-solid fa-graduation-cap"></i> Education
            </h2>
            @foreach ($user->qualifications as $qualification)
                <div class="exp-item">
                    <div class="exp-header">
                        <span class="exp-title">{{ $qualification->education_level }}</span>
                        <span class="exp-date">{{ $qualification->passing_year }}</span>
                    </div>
                    <div class="exp-company">{{ $qualification->institute_name }}</div>
                    <p>{{ $qualification->degree_title }}</p>
                </div>
            @endforeach
        </section>

        <section class="section">
            <h2 class="section-title">
                <i class="fa-solid fa-layer-group"></i> Skills
            </h2>
            @foreach ($user->skills as $skill)
                <div class="skill-category">
                    <div class="skill-category-title">{{ $skill->name }}</div>
                    <ul class="skill-list">
                        @if ($skill->skill_learned_from)
                            @foreach ($skill->skill_learned_from as $value)
                                <li>{{ $value }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            @endforeach
        </section>
        <section class="section">
            <h2 class="section-title">
                <i class="fa-solid fa-globe"></i> Languages
            </h2>
            @foreach($user->languageProficiencies as $lang)
            <div class="language-item">
                <span class="lang-name">{{$lang->language_name}}</span>
                @if($lang->speaking_level=="High")
                <div class="dots">
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                </div>
                @endif
                @if($lang->speaking_level=="Medium")
                <div class="dots">
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot"></div>
                </div>
                @endif
                @if($lang->speaking_level=="Low")
                <div class="dots">
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot filled"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
                @endif
            </div>
            @endforeach
        </section>
    </div>
</div>
