@extends('Front.layouts.website')

@section('title', 'Blog - ' . webConfig('web_title', 'Sparsh Heart and Women Clinic'))

@push('styles')

<link rel="stylesheet"
      href="{{ asset('front/css/blog.css') }}">

@endpush


@section('content')


<!-- =====================================================
     BLOG PAGE BANNER
===================================================== -->

<section class="blog-page-banner">

    <div class="container">

        <div class="text-center">

            <div class="section-label">

                Health & Wellness

            </div>


            <h1>

                Our Latest
                <span>Health Articles</span>

            </h1>


            <p>

                Helpful information, expert insights and
                healthcare guidance for women and families.

            </p>


            <div class="breadcrumb-custom">

                <a href="{{ route('website.index') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>
                    Blog
                </span>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     BLOG LIST
===================================================== -->

<section class="blog-main-section section-padding">

    <div class="container">


        <!-- HEADING -->

        <div class="text-center section-heading">

            <div class="section-label">

                From Our Blog

            </div>


            <h2 class="section-title">

                Health Tips &
                <span>Expert Advice</span>

            </h2>


            <p class="section-heading-description">

                Explore our latest articles covering pregnancy,
                fertility, women's health and general wellness.

            </p>

        </div>



        <!-- BLOG GRID -->

        <div class="row g-4">


            @forelse($blogs as $blog)

                <div class="col-lg-4 col-md-6">


                    <article class="blog-card">


                        <!-- IMAGE -->

                        <div class="blog-card-image">

                            @if($blog->image)

                                <img
                                    src="{{ asset('storage/' . $blog->image) }}"
                                    alt="{{ $blog->title }}">

                            @else

                                <div class="blog-placeholder">

                                    <i class="bi bi-journal-medical"></i>

                                </div>

                            @endif


                            <!-- DATE -->

                            @if($blog->published_at)

                                <div class="blog-date">

                                    <strong>
                                        {{ $blog->published_at->format('d') }}
                                    </strong>

                                    <span>
                                        {{ $blog->published_at->format('M') }}
                                    </span>

                                </div>

                            @endif

                        </div>



                        <!-- CONTENT -->

                        <div class="blog-card-content">


                            <!-- META -->

                            <div class="blog-meta">

                                @if($blog->author)

                                    <span>

                                        <i class="bi bi-person"></i>

                                        {{ $blog->author }}

                                    </span>

                                @endif


                                <span>

                                    <i class="bi bi-calendar3"></i>

                                    {{ $blog->published_at
                                        ? $blog->published_at->format('d M Y')
                                        : 'Health Update'
                                    }}

                                </span>

                            </div>



                            <!-- TITLE -->

                            <h3>

                                {{ $blog->title }}

                            </h3>



                            <!-- DESCRIPTION -->

                            @if($blog->short_description)

                                <p>

                                    {{ $blog->short_description }}

                                </p>

                            @endif



                            <!-- LINK -->

                            <a
                                href="{{ route(
                                    'website.blog.details',
                                    $blog->slug
                                ) }}"
                                class="blog-read-more">

                                Read More

                                <i class="bi bi-arrow-right"></i>

                            </a>


                        </div>


                    </article>

                </div>


            @empty

                <div class="col-12">

                    <div class="blog-empty">

                        <div class="blog-empty-icon">

                            <i class="bi bi-journal-medical"></i>

                        </div>

                        <h3>
                            No Articles Available
                        </h3>

                        <p>
                            Please check back soon for new
                            health and wellness articles.
                        </p>

                        <a
                            href="{{ route('website.contact') }}"
                            class="btn btn-primary-custom">

                            Contact Us

                        </a>

                    </div>

                </div>

            @endforelse


        </div>

    </div>

</section>



@endsection