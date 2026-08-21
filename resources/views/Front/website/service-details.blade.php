@extends('Front.layouts.website')

@section(
    'title',
    $service->title . ' - Sparsh Heart and Women Clinic'
)

@push('styles')

<link rel="stylesheet"
      href="{{ asset('front/css/service-details.css') }}">

@endpush


@section('content')


<!-- =====================================================
     SERVICE DETAIL BANNER
===================================================== -->

<section class="service-detail-banner">

    <div class="container">

        <div class="text-center">

            <div class="section-label">
                Our Medical Service
            </div>

            <h1>
                {{ $service->title }}
            </h1>

            @if($service->short_description)

                <p>
                    {{ $service->short_description }}
                </p>

            @endif


            <!-- BREADCRUMB -->

            <div class="breadcrumb-custom">

                <a href="{{ route('website.index') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <a href="{{ route('website.services') }}">
                    Services
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>
                    {{ $service->title }}
                </span>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     SERVICE DETAILS
===================================================== -->

<section class="service-detail-content section-padding">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="service-detail-box">


                    <!-- =================================================
                         SERVICE IMAGE
                    ================================================== -->

                    @if($service->icon)

                        <div class="service-detail-image">

                            <img
                                src="{{ asset('storage/' . $service->icon) }}"
                                alt="{{ $service->title }}">

                        </div>

                    @endif



                    <!-- =================================================
                         SERVICE HEADING
                    ================================================== -->

                    <div class="service-detail-heading">

    
                        <div>

                            <div class="service-detail-label">
                                Specialized Service
                            </div>

                            <h2>
                                {{ $service->title }}
                            </h2>

                        </div>

                    </div>



                    <!-- =================================================
                         SHORT DESCRIPTION
                    ================================================== -->

                    @if($service->short_description)

                        <p class="service-detail-lead">

                            {{ $service->short_description }}

                        </p>

                    @endif



                    <!-- =================================================
                         FULL DETAILS
                    ================================================== -->

                    @if($service->details)

                        <div class="service-detail-text">

                            {!! $service->details !!}

                        </div>

                    @else

                        <p class="service-no-details">

                            Please contact us for more information
                            about this service.

                        </p>

                    @endif



                    <!-- =================================================
                         ACTION BUTTONS
                    ================================================== -->

                    <div class="service-detail-actions">

                        <a
                            href="{{ route('website.contact') }}#appointment"
                            class="btn btn-primary-custom">

                            <i class="bi bi-calendar-check"></i>

                            Book Appointment

                        </a>


                        <a
                            href="{{ route('website.services') }}"
                            class="btn service-back-btn">

                            <i class="bi bi-arrow-left"></i>

                            Back to Services

                        </a>

                    </div>


                </div>

            </div>

        </div>

    </div>

</section>


@endsection