@extends('Front.layouts.website')

@section('title', 'Dr. Care - Advanced Healthcare')

@section('content')

<!-- =====================================================
     HERO
===================================================== -->

<section class="hero-section">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="bi bi-lightning-fill"></i>
                    Same-Day Consultations Available
                </div>


                <h1 class="hero-title">
                   {{ webConfig('banner_title', 'Advanced ENT Care You Can Trust') }}
                </h1>


                <p class="hero-description">
                    {{ webConfig('banner_description', 'One-stop clinic for ear, nose, throat, thyroid and head & neck conditions led by experienced specialists.') }}
                </p>


                <div class="hero-buttons">
                    <a href="{{ route('website.contact') }}#appointment"
                       class="btn btn-primary-custom btn-lg">
                        <i class="bi bi-calendar-check"></i>
                        Book Appointment
                    </a>


                    <a href="tel:{{ webConfig('primary_phone', '123457890') }}"
                       class="btn btn-call btn-lg">
                        <i class="bi bi-telephone-fill"></i>
                        Call Now
                    </a>
                </div>


                <div class="hero-stats">

                    <div class="stat-item">
                        <div class="rating">
                            ★★★★★
                        </div>
                        <strong>
                            4.9
                        </strong>
                        <span>
                            500+ Reviews
                        </span>
                    </div>

                    <div class="stat-item">
                         <div class="rating">
                          <i class="bi bi-calendar2-check"></i>
                        </div>
                        <strong>
                            16
                        </strong>
                        <span>
                            Years Experience
                        </span>
                    </div>


                    <div class="stat-item">
                          <div class="rating">
                          <i class="bi bi-people"></i>
                        </div>
                        <strong>
                            10,000+
                        </strong>
                        <span>
                            Happy Patients
                        </span>
                    </div>

                </div>

            </div>


            <!-- IMAGE SLIDER -->

         <!-- IMAGE SLIDER -->

            <div class="col-lg-6">

                <div class="hero-image-wrapper">

                    @if($banners->count())

                        <div id="doctorCarousel"
                            class="carousel slide"
                            data-bs-ride="carousel">

                            <!-- SLIDES -->

                            <div class="carousel-inner">

                                @foreach($banners as $key => $banner)

                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                                        <div class="doctor-image-box">

                                            <img src="{{ asset('storage/' . $banner->image) }}"
                                                alt="{{ $banner->title }}"
                                                class="doctor-image">

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            <!-- PREVIOUS -->

                            @if($banners->count() > 1)

                                <button class="carousel-control-prev"
                                        type="button"
                                        data-bs-target="#doctorCarousel"
                                        data-bs-slide="prev">

                                    <span class="carousel-control-prev-icon"></span>

                                </button>


                                <!-- NEXT -->

                                <button class="carousel-control-next"
                                        type="button"
                                        data-bs-target="#doctorCarousel"
                                        data-bs-slide="next">

                                    <span class="carousel-control-next-icon"></span>

                                </button>


                                <!-- INDICATORS -->

                                <div class="carousel-indicators">

                                    @foreach($banners as $key => $banner)

                                        <button type="button"
                                                data-bs-target="#doctorCarousel"
                                                data-bs-slide-to="{{ $key }}"
                                                class="{{ $key == 0 ? 'active' : '' }}"
                                                aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                                                aria-label="Slide {{ $key + 1 }}">
                                        </button>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    @else

                        <!-- FALLBACK IMAGE -->

                        <div class="doctor-image-box">

                            <img src="{{ asset('front/images/doctor-1.jpg') }}"
                                alt="Doctor"
                                class="doctor-image">

                        </div>

                    @endif


                    <!-- APPOINTMENT CARD -->

                    <div class="appointment-card">

                        <div class="appointment-icon">

                            <i class="bi bi-calendar-check"></i>

                        </div>

                        <div>

                            <strong>
                                Appointments Open
                            </strong>

                            <small>
                                Book your consultation today
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     ABOUT PREVIEW
===================================================== -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="section-label">
                    About Our Clinic
                </div>
                <h2 class="section-title">
                  {{ webConfig('about_title', 'About Our Clinic') }}
                </h2>
                <p>
                    {!! webConfig('about_description', 'We provide advanced diagnosis and treatment for ear, nose, throat, thyroid and head & neck conditions.') !!}
                </p>
                <a href="{{ route('website.about') }}"
                   class="btn btn-primary-custom">
                    Learn More
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            
            <div class="col-lg-6">
              <img
                    src="{{ webConfig('about_image')
                        ? asset('storage/' . webConfig('about_image'))
                        : asset('front/images/about-doctor.jpg') }}"
                    alt="{{ webConfig('about_title', 'About Doctor') }}"
                    class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</section>


<!-- =====================================================
     SERVICES PREVIEW
===================================================== -->

<!-- =====================================================
     SERVICES PREVIEW
===================================================== -->

<section class="section-padding services-section">

    <div class="container">


        <!-- HEADING -->

        <div class="text-center section-heading">

            <div class="section-label">
                Our Services
            </div>

            <h2 class="section-title">

                Specialized Healthcare
                <span>Services</span>

            </h2>

        </div>


        <!-- SERVICES -->

        <div class="row g-4">


            @forelse($services as $service)


                <div class="col-lg-4 col-md-6">

                    <div class="service-card">


                        <!-- ICON -->

                        <div class="service-icon">

                            @if($service->icon)

                                <img
                                    src="{{ asset('storage/' . $service->icon) }}"
                                    alt="{{ $service->title }}">

                            @else

                                <i class="bi bi-heart-pulse"></i>

                            @endif

                        </div>


                        <!-- TITLE -->

                        <h4>

                            {{ $service->title }}

                        </h4>


                        <!-- DESCRIPTION -->

                        <p>

                            {{ $service->short_description }}

                        </p>


                        <!-- LINK -->

                        <a
                            href="{{ route('website.services') }}#{{ $service->slug }}">

                            Learn More

                            <i class="bi bi-arrow-right"></i>

                        </a>


                    </div>

                </div>


            @empty

                <div class="col-12 text-center">

                    <p>
                        No services available at the moment.
                    </p>

                </div>

            @endforelse


        </div>


        <!-- VIEW ALL -->

        <div class="text-center mt-5">

            <a
                href="{{ route('website.services') }}"
                class="btn btn-primary-custom">

                View All Services

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>


    </div>

</section>


<!-- =====================================================
     BLOG PREVIEW
===================================================== -->

<section class="section-padding">

    <div class="container">

        <div class="text-center section-heading">

            <div class="section-label">
                Health Blog
            </div>

            <h2 class="section-title">

                Latest Health
                <span>Articles</span>

            </h2>

        </div>


        <div class="row g-4">


            @foreach($blogs as $blog)

                <div class="col-lg-4">

                    <div class="blog-card">

                        <div class="blog-image">

                            <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('front/images/blog-1.jpg') }}"
                                 alt="Health Blog">

                        </div>


                        <div class="blog-content">

                            <span class="blog-date">

                               {{ $blog->published_at->format('d M Y') }}

                            </span>


                            <h4>

                                {{ $blog->title }}

                            </h4>


                            <p>

                                {{ Str::limit($blog->short_description, 100) }}

                            </p>


                            <a href="{{ route('website.blog.details', $blog->slug) }}">

                                Read More

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach


        </div>


        <div class="text-center mt-5">

            <a href="{{ route('website.blog') }}"
               class="btn btn-primary-custom">

                View All Articles

            </a>

        </div>

    </div>

</section>

@endsection 