@extends('Front.layouts.website')
@section('title', 'Contact Us & Book Appointment - Dr. Care')

@push('styles')
    <link rel="stylesheet"  href="{{ asset('front/css/contact.css') }}"> 
@endpush

@section('content')

<section class="contact-page-banner">

    <div class="container">

        <div class="text-center">

            <div class="section-label">
                Get In Touch
            </div>

            <h1>
                Contact Us &
                <span>
                    Book Appointment
                </span>
            </h1>

            <p>
                Have a question or need medical consultation?
                Our team is here to help.
            </p>

            <div class="breadcrumb-custom">
                <a href="{{ route('website.index') }}">
                    Home
                </a>
                <i class="bi bi-chevron-right"></i>
                <span>
                    Contact Us
                </span>
            </div>

        </div>

    </div>

</section>


<!-- CONTACT INFORMATION -->

<section class="section-padding">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">

                <div class="contact-info-card">

                    <div class="contact-info-icon">

                        <i class="bi bi-geo-alt-fill"></i>

                    </div>

                    <h4>
                        Visit Our Clinic
                    </h4>

                    <p>
                      {{ webConfig('address', 'Default Title') }}
                    </p>

                    <a href="https://www.google.com/maps?q={{ urlencode(webConfig('address', 'Default Title')) }}" target="_blank">
                        Get Directions
                    </a>

                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="contact-info-card">

                    <div class="contact-info-icon">

                        <i class="bi bi-telephone-fill"></i>

                    </div>

                    <h4>
                        Call Us
                    </h4>

                    <p>
                     {{ webConfig('primary_phone', 'Default Title') }}<br>
                        {{webConfig('secondary_phone', 'Default Title')}}
                    </p>

                    <a href="tel:{{ webConfig('primary_phone', 'Default Title') }}">
                        Call Now
                    </a>

                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="contact-info-card">

                    <div class="contact-info-icon">

                        <i class="bi bi-envelope-fill"></i>

                    </div>

                    <h4>
                        Email Us
                    </h4>

                    <p>
                        {{webConfig('primary_email', 'Default Title')}}<br>
                        {{webConfig('support_email', 'Default Title')}}
                    </p>

                    <a href="mailto:{{webConfig('primary_email', 'Default Title')}}">
                        Send Email
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     SINGLE APPOINTMENT / CONTACT FORM
===================================================== -->

<section class="section-padding appointment-contact-section"
         id="appointment">

    <div class="container">

        <div class="row g-5">


            <div class="col-lg-5">

                <div class="section-label">

                    Book Your Visit

                </div>

                <h2 class="section-title">

                    Schedule Your
                    <span>Appointment</span>

                </h2>

                <p>

                    Fill out the form and our clinic team will
                    contact you to confirm your appointment.

                </p>


                <div class="appointment-benefit">

                    <div class="appointment-benefit-icon">

                        <i class="bi bi-calendar-check"></i>

                    </div>

                    <div>

                        <h5>
                            Easy Appointment Booking
                        </h5>

                        <p>
                            Choose your preferred date and time.
                        </p>

                    </div>

                </div>


                <div class="appointment-benefit">

                    <div class="appointment-benefit-icon">

                        <i class="bi bi-person-check"></i>

                    </div>

                    <div>

                        <h5>
                            Expert Consultation
                        </h5>

                        <p>
                            Get consultation from experienced
                            specialists.
                        </p>

                    </div>

                </div>


                <div class="direct-call-box">

                    <div class="direct-call-icon">

                        <i class="bi bi-telephone-fill"></i>

                    </div>

                    <div>

                        <span>
                            Need urgent assistance?
                        </span>

                        <strong>
                            {{webConfig('primary_phone', 'Default Title')}}
                        </strong>

                    </div>

                    <a href="tel:{{webConfig('primary_phone', 'Default Title')}}">

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>


            <!-- FORM -->

            <div class="col-lg-7">

                <div class="appointment-form-card">

                    <div class="form-header">

                        <div>

                            <div class="section-label">

                                Appointment Request

                            </div>

                            <h3>

                                Tell Us How We Can Help

                            </h3>

                        </div>

                        <div class="form-header-icon">

                            <i class="bi bi-calendar-heart"></i>

                        </div>

                    </div>


                    <form action="#"
                          method="POST">

                        @csrf

                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">

                                    Full Name
                                    <span>*</span>

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-person"></i>

                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           placeholder="Enter your name"
                                           required>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">

                                    Phone Number
                                    <span>*</span>

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-telephone"></i>

                                    <input type="tel"
                                           name="phone"
                                           class="form-control"
                                           placeholder="Enter phone number"
                                           required>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">

                                    Email Address

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-envelope"></i>

                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="Enter email">

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">

                                    Select Service
                                    <span>*</span>

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-heart-pulse"></i>

                                    <select name="service"
                                            class="form-select"
                                            required>

                                        <option value="">
                                            Select Service
                                        </option>

                                        <option value="ear">
                                            Ear Care
                                        </option>

                                        <option value="sinus">
                                            Nose & Sinus Care
                                        </option>

                                        <option value="throat">
                                            Throat Care
                                        </option>

                                        <option value="thyroid">
                                            Thyroid Care
                                        </option>

                                        <option value="general">
                                            General Consultation
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">

                                    Preferred Date
                                    <span>*</span>

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-calendar3"></i>

                                    <input type="date"
                                           name="appointment_date"
                                           class="form-control"
                                           required>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">

                                    Preferred Time
                                    <span>*</span>

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-clock"></i>

                                    <select name="appointment_time"
                                            class="form-select"
                                            required>

                                        <option value="">
                                            Select Time
                                        </option>

                                        <option value="09:00">
                                            09:00 AM
                                        </option>

                                        <option value="10:00">
                                            10:00 AM
                                        </option>

                                        <option value="11:00">
                                            11:00 AM
                                        </option>

                                        <option value="14:00">
                                            02:00 PM
                                        </option>

                                        <option value="15:00">
                                            03:00 PM
                                        </option>

                                        <option value="16:00">
                                            04:00 PM
                                        </option>

                                        <option value="17:00">
                                            05:00 PM
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="col-12">

                                <label class="form-label">

                                    Message / Health Concern

                                </label>

                                <div class="textarea-custom">

                                    <i class="bi bi-chat-left-text"></i>

                                    <textarea name="message"
                                              class="form-control"
                                              rows="5"
                                              placeholder="Tell us briefly about your concern..."></textarea>

                                </div>

                            </div>


                            <div class="col-12">

                                <button type="submit"
                                        class="btn btn-primary-custom appointment-submit">

                                    <i class="bi bi-calendar-check"></i>

                                    Request Appointment

                                    <i class="bi bi-arrow-right"></i>

                                </button>

                            </div>

                        </div>

                    </form>


                    <div class="form-note">

                        <i class="bi bi-shield-check"></i>

                        Your information is kept private and
                        will only be used to contact you.

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- MAP -->

<section class="section-padding"
         id="map">

    <div class="container">

        <div class="map-wrapper">

            <iframe
                src="https://www.google.com/maps?q={{ urlencode(webConfig('address', 'Default Title')) }}&output=embed"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>

        </div>

    </div>

</section>

@endsection