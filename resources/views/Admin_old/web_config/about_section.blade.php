@extends('Admin.layout.main')

@section('content')
@push('styles')

<link
    href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    rel="stylesheet">

@endpush

<div class="container">

    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">
                About Section Setting
            </h3>
            <ul class="breadcrumbs mb-3">
            </ul>
        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            About Section
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.web_config.about_section') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about_title">
                                            About Title
                                        </label>
                                        <input
                                            type="text"
                                            name="about_title"
                                            class="form-control"
                                            id="about_title"
                                            value="{{ old('about_title', $about_title ?? '') }}"
                                            placeholder="Enter About Title">
                                    </div>
                                </div>


                                {{-- ABOUT DESCRIPTION --}}

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about_description">
                                            About Description
                                        </label>
                                        <textarea
                                            name="about_description"
                                            class="form-control"
                                            id="about_description"
                                            rows="8"
                                            placeholder="Enter About Description">{{ old('about_description', $about_description ?? '') }}</textarea>
                                    </div>
                                </div>

                                {{-- ABOUT IMAGE --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about_image">
                                            About Image
                                        </label>
                                        <input
                                            type="file"
                                            name="about_image"
                                            id="about_image"
                                            class="form-control"
                                            accept="image/jpeg,image/png,image/webp">
                                        @if(!empty($about_image))
                                            <div class="mt-3">
                                                <img
                                                    src="{{ asset('storage/' . $about_image) }}"
                                                    alt="About Image"
                                                    style="
                                                        width: 250px;
                                                        height: 180px;
                                                        object-fit: cover;
                                                        border-radius: 10px;
                                                    ">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                              
                                <div class="col-md-12">
                                    
                                    <hr>
                                </div>
                                 <div class="page-header">
                                    <h3 class="fw-bold mb-3">
                                        Our Mission
                                    </h3>
                                    <ul class="breadcrumbs mb-3">
                                    </ul>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="our_mission_title">
                                            Our Mission Title
                                        </label>
                                        <input
                                            type="text"
                                            name="our_mission_title"
                                            class="form-control"
                                            id="our_mission_title"
                                            value="{{ old('our_mission_title', $our_mission_title ?? '') }}"
                                            placeholder="Enter Our Mission Title">
                                    </div>
                                </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="our_mission_description">
                                            Our Mission Description
                                        </label>
                                        <textarea
                                            name="our_mission_description"
                                            class="form-control"
                                            id="our_mission_description"
                                            rows="8"
                                            placeholder="Enter Our Mission Description">{{ old('our_mission_description', $our_mission_description ?? '') }}</textarea>
                                    </div>
                                </div>
                                 {{-- ABOUT IMAGE --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="our_mission_image">
                                            Our Mission Image
                                        </label>
                                        <input
                                            type="file"
                                            name="our_mission_image"
                                            id="our_mission_image"
                                            class="form-control"
                                            accept="image/jpeg,image/png,image/webp">
                                        @if(!empty($our_mission_image))
                                            <div class="mt-3">
                                                <img
                                                    src="{{ asset('storage/' . $our_mission_image) }}"
                                                    alt="Our Mission Image"
                                                    style="
                                                        width: 250px;
                                                        height: 180px;
                                                        object-fit: cover;
                                                        border-radius: 10px;
                                                    ">
                                            </div>
                                        @endif
                                    </div>
                                </div>


                            </div>


                            <div class="card-action mt-3">
                                <button  type="submit"  class="btn btn-success">
                                    <i class="fas fa-save"></i>
                                    Save Settings
                                </button>
                                <button  type="reset"  class="btn btn-danger">
                                    Reset
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>

    $(document).ready(function () {

        $('#about_description, #our_mission_description').summernote({

            height: 300,
            placeholder: 'Enter Description...',
            toolbar: [

                ['style', [
                    'style'
                ]],

                ['font', [
                    'bold',
                    'italic',
                    'underline',
                    'clear'
                ]],

                ['fontname', [
                    'fontname'
                ]],

                ['color', [
                    'color'
                ]],

                ['para', [
                    'ul',
                    'ol',
                    'paragraph'
                ]],

                ['table', [
                    'table'
                ]],

                ['insert', [
                    'link',
                    'picture',
                    'video'
                ]],

                ['view', [
                    'fullscreen',
                    'codeview',
                    'help'
                ]]

            ]
        });
    });
</script>

@endpush