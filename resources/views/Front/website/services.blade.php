@extends('Front.layouts.website')

@section('title', 'Our Services - Sparsh Heart and Women Clinic')

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('front/css/services.css') }}">
@endpush

@section('content')


<!-- =====================================================
     SERVICES PAGE BANNER
===================================================== -->

<section class="services-page-banner">

    <div class="container">

        <div class="text-center">

            <div class="section-label">
                Our Medical Services
            </div>


            <h1>

                Specialized Care For
                <span>Women & Families</span>

            </h1>


            <p>

                Compassionate and personalized healthcare
                for women, with specialized obstetric and
                gynaecological services tailored to
                individual needs.

            </p>


            <!-- BREADCRUMB -->

            <div class="breadcrumb-custom">

                <a href="{{ route('website.index') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>
                    Services
                </span>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     MAIN SERVICES
===================================================== -->

<section class="section-padding services-main-section">

    <div class="container">


        <!-- SECTION HEADING -->

        <div class="text-center section-heading">

            <div class="section-label">
                What We Offer
            </div>


            <h2 class="section-title">

                Our Specialized
                <span>Services</span>

            </h2>

        </div>



        <!-- SERVICE GRID -->

        <div class="row g-4">


            @forelse($services as $service)


                <div
                    class="col-lg-4 col-md-6"
                    id="{{ $service->slug }}">


                    <div class="service-large-card">


                        <!-- =================================
                             IMAGE + NUMBER
                        ================================= -->

                        <div class="service-card-top">


                            <!-- SERVICE IMAGE -->

                            @if($service->icon)

                                <div class="service-card-image">

                                    <img
                                        src="{{ asset('storage/' . $service->icon) }}"
                                        alt="{{ $service->title }}">

                                </div>

                            @else

                                <div class="service-card-image service-card-placeholder">

                                    <i class="bi bi-heart-pulse"></i>

                                </div>

                            @endif


                            <!-- SERVICE NUMBER -->

                            <span class="service-number">

                                {{ str_pad(
                                    $loop->iteration,
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}

                            </span>


                        </div>



                        <!-- =================================
                             SERVICE TITLE
                        ================================= -->

                        <h3>

                            {{ $service->title }}

                        </h3>



                        <!-- =================================
                             SHORT DESCRIPTION
                        ================================= -->

                        @if($service->short_description)

                            <p>

                                {{ $service->short_description }}

                            </p>

                        @endif



                        <!-- =================================
                             BOOK CONSULTATION
                        ================================= -->

                        <a href="{{ route('website.service.details', $service->slug) }}" class="service-card-link">
                            Learn More
                            <i class="bi bi-arrow-right"></i>
                        </a>


                    </div>

                </div>


            @empty


                <!-- NO SERVICES -->

                <div class="col-12">

                    <div class="no-services">

                        <div class="no-services-icon">

                            <i class="bi bi-heart-pulse"></i>

                        </div>


                        <h4>
                            No Services Available
                        </h4>


                        <p>

                            Our services will be available
                            here soon.

                        </p>

                    </div>

                </div>


            @endforelse


        </div>

    </div>

</section>

@endsection