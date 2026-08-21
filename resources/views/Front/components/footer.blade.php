<section class="appointment-section">
    <div class="container">
        <div class="appointment-box">
            <div>
                <div class="section-label light">
                    We're Here For You
                </div>
                <h2>
                    Your Health Deserves The Best Care
                </h2>
                <p>
                    Schedule a consultation with our experienced medical team today.
                </p>
            </div>
            <a href="{{ route('website.contact') }}#appointment" class="btn btn-light btn-lg">
                <i class="bi bi-calendar-check"></i>
                Book Appointment
            </a>
        </div>
    </div>
</section>

<!-- =====================================================
     FOOTER
===================================================== -->
<footer class="footer">

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <h4>
                  {{ webConfig('web_title', 'Default Title') }}
                </h4>
                <p>
                  {{ webConfig('tagline', 'Default Tagline') }}
                </p>
            </div>

            <div class="col-lg-2">
                <h5>
                    Quick Links
                </h5>
                <a href="{{ route('website.index') }}">
                    Home
                </a>
                <a href="{{ route('website.about') }}">
                    About Us
                </a>
                <a href="{{ route('website.services') }}">
                    Services
                </a>
                <a href="{{ route('website.blog') }}">
                    Blog
                </a>
                <a href="{{ route('website.contact') }}">
                    Contact Us
                </a>
            </div>


            <div class="col-lg-2">
                <h5>
                    Services
                </h5>
                <a href="{{ route('website.services') }}#ear-care">
                    Ear Care
                </a>
                <a href="{{ route('website.services') }}#sinus-care">
                    Sinus Care
                </a>
                <a href="{{ route('website.services') }}">
                    Throat Care
                </a>
                <a href="{{ route('website.services') }}">
                    Thyroid
                </a>
            </div>

            <div class="col-lg-3">
                <h5>
                    Contact
                </h5>
                <p>
                    <i class="bi bi-telephone"></i>
                    {{ webConfig('primary_phone', 'Default Phone') }}
                </p>

                <p>
                    <i class="bi bi-envelope"></i>
                    {{ webConfig('primary_email', 'Default Email') }}

                </p>

                @if(
                        !empty(webConfig('instagram_link')) ||
                        !empty(webConfig('youtube_link')) ||
                        !empty(webConfig('facebook_link')) ||
                        !empty(webConfig('twitter_link'))
                    )

                        <div class="footer-social-links">

                            @if(!empty(webConfig('instagram_link')))

                                <a href="{{ webConfig('instagram_link') }}"
                                target="_blank"
                                aria-label="Instagram">

                                    <i class="bi bi-instagram"></i>

                                </a>

                            @endif


                            @if(!empty(webConfig('youtube_link')))

                                <a href="{{ webConfig('youtube_link') }}"
                                target="_blank"
                                aria-label="YouTube">

                                    <i class="bi bi-youtube"></i>

                                </a>

                            @endif


                            @if(!empty(webConfig('facebook_link')))

                                <a href="{{ webConfig('facebook_link') }}"
                                target="_blank"
                                aria-label="Facebook">

                                    <i class="bi bi-facebook"></i>

                                </a>

                            @endif


                            @if(!empty(webConfig('twitter_link')))

                                <a href="{{ webConfig('twitter_link') }}"
                                target="_blank"
                                aria-label="Twitter">

                                    <i class="bi bi-twitter"></i>

                                </a>

                            @endif

                        </div>

                    @endif

            </div>

        </div>


        <div class="footer-bottom">

            © {{ date('Y') }}  {{ webConfig('web_title', 'Default Title') }}.
            All Rights Reserved.

        </div>

    </div>

</footer>


<!-- WhatsApp -->

<a href="https://wa.me/{{ webConfig('primary_phone', 'Default Phone') }}" class="whatsapp-button" target="_blank">
    <i class="bi bi-whatsapp"></i>
</a>