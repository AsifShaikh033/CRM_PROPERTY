@extends('Front.layouts.website')

@section('title', 'About Us - Dr. Care')


@push('styles')
    <link rel="stylesheet"
          href="{{ asset('front/css/about.css') }}">
@endpush

@section('content')

<section class="about-page-banner">
    <div class="container">
        <div class="text-center">
            <div class="section-label">
                About Our Clinic
            </div>
            <h1>
                About <span>{{ webConfig('web_title', 'About Our Clinic') }}</span>
            </h1>
            <p>
                {{ webConfig('tagline', 'Compassionate care. Advanced treatment. Better health.') }}
            </p>
            <div class="breadcrumb-custom">
                <a href="{{ route('website.index') }}">
                    Home
                </a>
                <i class="bi bi-chevron-right"></i>
                <span>
                    About Us
                </span>
            </div>
        </div>
    </div>
</section>


<section class="section-padding">

    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <div class="about-main-image">
                    <img src="{{ webConfig('about_image') ? asset('storage/' . webConfig('about_image')) : asset('front/images/about-doctor.jpg') }}"
                         alt="Doctor">
                    <div class="experience-badge">
                        <strong>
                            16+
                        </strong>
                        <span>
                            Years of<br>
                            Experience
                        </span>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="section-label">
                    Who We Are
                </div>
                <h2 class="section-title">
                  {{ webConfig('about_title', 'Advanced Healthcare') }}
                </h2>
                <p class="about-lead">
                    {!! webConfig('about_description', 'At Dr. Care, we believe that quality healthcare starts with listening to our patients.') !!}
                </p>
                <a href="{{ route('website.contact') }}#appointment"
                   class="btn btn-primary-custom mt-3">
                    Book Appointment
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</section>


<section class="about-stats-section">
    <div class="container">
        <div class="row g-4">
            @php
                $stats = [
                    ['number' => '16+', 'text' => 'Years Experience', 'icon' => 'bi-calendar2-check'],
                    ['number' => '10,000+', 'text' => 'Happy Patients', 'icon' => 'bi-people'],
                    ['number' => '4.9', 'text' => 'Patient Rating', 'icon' => 'bi-star-fill'],
                    ['number' => '20+', 'text' => 'Medical Services', 'icon' => 'bi-award'],
                ];

            @endphp
            @foreach($stats as $stat)
                <div class="col-lg-3 col-md-6">
                    <div class="about-stat-card">
                        <div class="about-stat-icon">
                            <i class="bi {{ $stat['icon'] }}"></i>
                        </div>
                        <strong>
                            {{ $stat['number'] }}
                        </strong>
                        <span>
                            {{ $stat['text'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="section-label">
                    Our Mission
                </div>
                <h2 class="section-title">
                  {{ webConfig('our_mission_title', 'Your Health, Our Priority') }}
                </h2>

                <p>
                    {!! webConfig('our_mission_description', 'We are committed to providing the highest quality healthcare with compassion and expertise.') !!}
                </p>

            </div>
            <div class="col-lg-6">
                <div class="mission-image">
                    <img  src="{{ webConfig('our_mission_image') ? asset('storage/' . webConfig('our_mission_image')) : asset('front/images/clinic.jpg') }}"
                         alt="Clinic">
                </div>
            </div>

        </div>

    </div>

</section>


<section class="section-padding d-none">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="doctor-profile-image">
                    <img src="{{ asset('front/images/doctor-profile.jpg') }}"
                         alt="Doctor">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="section-label">
                    Meet Your Doctor
                </div>
                <h2 class="section-title">
                    Dr. John
                    <span>Smith</span>
                </h2>
                <h5 class="doctor-speciality">
                    Consultant ENT & Head Neck Surgeon
                </h5>
                <p>
                    Dr. John Smith is an experienced ENT specialist
                    providing diagnosis and treatment for ear, nose,
                    throat, thyroid and head & neck conditions.
                </p>

                <div class="doctor-qualifications">
                    <span>
                        <i class="bi bi-check-circle-fill"></i>
                        MBBS
                    </span>
                    <span>
                        <i class="bi bi-check-circle-fill"></i>
                        MS ENT
                    </span>
                    <span>
                        <i class="bi bi-check-circle-fill"></i>
                        Fellowship
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection