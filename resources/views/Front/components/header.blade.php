<!-- =====================================================
     TOP BAR
===================================================== -->

<div class="top-bar">

    <div class="container">

        <div class="top-bar-content">

            <span>
                <strong>{{ webConfig('web_title', 'Default Title') }}</strong>
            </span>

            <span>
                <i class="bi bi-geo-alt-fill"></i>
                {{ webConfig('address', 'Default Address') }}
            </span>

            <span>
                <i class="bi bi-telephone-fill"></i>
                {{ webConfig('primary_phone', '9876543210') }}
            </span>

            <span>
                <i class="bi bi-envelope-fill"></i>
                {{ webConfig('primary_email', 'contact@test.com') }}
            </span>

        </div>

    </div>

</div>


<!-- =====================================================
     NAVBAR
===================================================== -->

<nav class="navbar navbar-expand-lg main-navbar">

    <div class="container">

        <a class="navbar-brand"
           href="{{ route('website.index') }}">

            <img  src="{{ asset('storage/' . webConfig('logo')) }}"
                 alt="{{ webConfig('web_title', 'Default Title') }}"
                 class="website-logo" height="50" width="auto">

        </a>


        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div class="collapse navbar-collapse"
             id="mainNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">


                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('website.index') ? 'active' : '' }}"
                       href="{{ route('website.index') }}">

                        Home

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('website.about') ? 'active' : '' }}"
                       href="{{ route('website.about') }}">

                        About Us

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('website.services') ? 'active' : '' }}"
                       href="{{ route('website.services') }}">

                        Services

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('website.blog') ? 'active' : '' }}"
                       href="{{ route('website.blog') }}">

                        Blog

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('website.contact') ? 'active' : '' }}"
                       href="{{ route('website.contact') }}">

                        Contact Us

                    </a>

                </li>


                <li class="nav-item ms-lg-3">

                    <a href="{{ route('website.contact') }}#appointment"
                       class="btn btn-primary-custom">

                        <i class="bi bi-calendar-check"></i>

                        Book Appointment

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>