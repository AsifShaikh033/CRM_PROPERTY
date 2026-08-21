@extends('Front.layouts.website')

@section(
    'title',
    $blog->meta_title
        ?: $blog->title . ' - ' . webConfig(
            'web_title',
            'Sparsh Heart and Women Clinic'
        )
)


@push('styles')

<link rel="stylesheet"
      href="{{ asset('front/css/blog-detail.css') }}">

@endpush

@section('content')


<!-- =====================================================
     BLOG DETAIL BANNER
===================================================== -->

<section class="blog-detail-banner">

    <div class="container">

        <div class="text-center">

            <div class="section-label">

                Health & Wellness

            </div>


            <h1>

                {{ $blog->title }}

            </h1>


            <div class="blog-detail-meta">

                @if($blog->author)

                    <span>

                        <i class="bi bi-person"></i>

                        {{ $blog->author }}

                    </span>

                @endif


                @if($blog->published_at)

                    <span>

                        <i class="bi bi-calendar3"></i>

                        {{ $blog->published_at->format('d M Y') }}

                    </span>

                @endif

            </div>


            <div class="breadcrumb-custom">

                <a href="{{ route('website.index') }}">
                    Home
                </a>

                <i class="bi bi-chevron-right"></i>

                <a href="{{ route('website.blog') }}">
                    Blog
                </a>

                <i class="bi bi-chevron-right"></i>

                <span>
                    {{ $blog->title }}
                </span>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     BLOG CONTENT
===================================================== -->

<section class="blog-detail-section section-padding">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-9">


                <article class="blog-detail-card">


                    <!-- FEATURED IMAGE -->

                    @if($blog->image)

                        <div class="blog-detail-image">

                            <img
                                src="{{ asset('storage/' . $blog->image) }}"
                                alt="{{ $blog->title }}">

                        </div>

                    @endif



                    <!-- ARTICLE CONTENT -->

                    <div class="blog-detail-content">


                        <!-- DATE / AUTHOR -->

                        <div class="blog-detail-info">

                            @if($blog->published_at)

                                <span>

                                    <i class="bi bi-calendar3"></i>

                                    Published on
                                    {{ $blog->published_at->format('d M Y') }}

                                </span>

                            @endif


                            @if($blog->author)

                                <span>

                                    <i class="bi bi-person"></i>

                                    By {{ $blog->author }}

                                </span>

                            @endif

                        </div>



                        <!-- TITLE -->

                        <h2>

                            {{ $blog->title }}

                        </h2>



                        <!-- SHORT DESCRIPTION -->

                        @if($blog->short_description)

                            <div class="blog-detail-intro">

                                {{ $blog->short_description }}

                            </div>

                        @endif



                        <!-- FULL DESCRIPTION -->

                        @if($blog->description)

                            <div class="blog-detail-text">

                                {!! $blog->description !!}

                            </div>

                        @else

                            <p>

                                More information about this article
                                will be available soon.

                            </p>

                        @endif



                        <!-- BACK -->

                        <div class="blog-detail-actions">

                            <a
                                href="{{ route('website.blog') }}"
                                class="btn blog-back-btn">

                                <i class="bi bi-arrow-left"></i>

                                Back to Blog

                            </a>


                            <a
                                href="{{ route('website.contact') }}#appointment"
                                class="btn btn-primary-custom">

                                <i class="bi bi-calendar-check"></i>

                                Book Appointment

                            </a>

                        </div>


                    </div>

                </article>

            </div>

        </div>

    </div>

</section>



@endsection