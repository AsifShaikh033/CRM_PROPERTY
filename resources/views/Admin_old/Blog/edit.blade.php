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
                Blog Setting
            </h3>

        </div>



        @if($errors->any())

            <div class="alert alert-danger">

                <ul>

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

                            Blog Details

                        </div>

                    </div>



                    <div class="card-body">


                        <form
                            action="{{ route(
                                'admin.updateBlog',
                                $Data->id
                            ) }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf



                            <div class="row">


                                <!-- TITLE -->

                                <div class="col-md-8">

                                    <div class="form-group mb-3">

                                        <label>
                                            Blog Title
                                        </label>

                                        <input
                                            type="text"
                                            name="title"
                                            class="form-control"
                                            value="{{ $Data->title }}"
                                            required>

                                    </div>

                                </div>



                                <!-- AUTHOR -->

                                <div class="col-md-4">

                                    <div class="form-group mb-3">

                                        <label>
                                            Author
                                        </label>

                                        <input
                                            type="text"
                                            name="author"
                                            class="form-control"
                                            value="{{ $Data->author }}"
                                            placeholder="Author Name">

                                    </div>

                                </div>



                                <!-- IMAGE -->

                                <div class="col-md-6">

                                    <div class="form-group mb-3">

                                        <label>
                                            Blog Image
                                        </label>

                                        <input
                                            type="file"
                                            name="image"
                                            class="form-control"
                                            accept="image/jpeg,image/png,image/jpg,image/webp">


                                        @if($Data->image)

                                            <div class="mt-3">

                                                <img
                                                    src="{{ asset(
                                                        'storage/' . $Data->image
                                                    ) }}"
                                                    alt="{{ $Data->title }}"
                                                    style="
                                                        width:180px;
                                                        height:110px;
                                                        object-fit:cover;
                                                        border-radius:10px;
                                                    ">

                                            </div>

                                        @endif

                                    </div>

                                </div>



                                <!-- PUBLISHED DATE -->

                                <div class="col-md-6 d-none">

                                    <div class="form-group mb-3">

                                        <label>
                                            Published Date
                                        </label>

                                        <input
                                            type="date"
                                            name="published_at"
                                            class="form-control"
                                            value="{{ $Data->published_at ? $Data->published_at->format('Y-m-d') : '' }}">

                                    </div>

                                </div>



                                <!-- SHORT DESCRIPTION -->

                                <div class="col-md-12">

                                    <div class="form-group mb-3">

                                        <label>
                                            Short Description
                                        </label>

                                        <textarea
                                            name="short_description"
                                            class="form-control"
                                            rows="3"
                                            maxlength="500">{{ $Data->short_description }}</textarea>

                                    </div>

                                </div>



                                <!-- DESCRIPTION -->

                                <div class="col-md-12">

                                    <div class="form-group mb-3">

                                        <label>
                                            Blog Description
                                        </label>

                                        <textarea
                                            name="description"
                                            id="blog_description"
                                            class="form-control"
                                            rows="10">{{ $Data->description }}</textarea>

                                    </div>

                                </div>



                                <!-- PRIORITY -->

                                <div class="col-md-6">

                                    <div class="form-group mb-3">

                                        <label>
                                            Priority
                                        </label>

                                        <input
                                            type="number"
                                            name="priority"
                                            value="{{ $Data->priority }}"
                                            class="form-control"
                                            min="0">

                                    </div>

                                </div>



                                <!-- STATUS -->

                                <div class="col-md-6">

                                    <div class="form-group mb-3">

                                        <label>
                                            Status
                                        </label>

                                        <select
                                            name="status"
                                            class="form-control">

                                            <option
                                                value="1"
                                                {{ $Data->status == 1 ? 'selected' : '' }}>

                                                Active

                                            </option>

                                            <option
                                                value="0"
                                                {{ $Data->status == 0 ? 'selected' : '' }}>

                                                Inactive

                                            </option>

                                        </select>

                                    </div>

                                </div>



                                <!-- META TITLE -->

                                <div class="col-md-12">

                                    <div class="form-group mb-3">

                                        <label>
                                            Meta Title
                                        </label>

                                        <input
                                            type="text"
                                            name="meta_title"
                                            class="form-control"
                                            value="{{ $Data->meta_title }}">

                                    </div>

                                </div>



                                <!-- META KEYWORDS -->

                                <div class="col-md-12">

                                    <div class="form-group mb-3">

                                        <label>
                                            Meta Keywords
                                        </label>

                                        <textarea
                                            name="meta_keywords"
                                            class="form-control"
                                            rows="2">{{ $Data->meta_keywords }}</textarea>

                                    </div>

                                </div>



                                <!-- META DESCRIPTION -->

                                <div class="col-md-12">

                                    <div class="form-group mb-3">

                                        <label>
                                            Meta Description
                                        </label>

                                        <textarea
                                            name="meta_description"
                                            class="form-control"
                                            rows="3"
                                            maxlength="1000">{{ $Data->meta_description }}</textarea>

                                    </div>

                                </div>


                            </div>



                            <div class="card-action">

                                <button
                                    type="submit"
                                    class="btn btn-success">

                                    <i class="fa fa-save"></i>

                                    Save

                                </button>


                                <a
                                    href="{{ route('admin.blog.list') }}"
                                    class="btn btn-secondary">

                                    Back

                                </a>

                            </div>


                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>


<script>

$(document).ready(function () {

    $('#blog_description').summernote({

        height: 350,

        placeholder:
            'Write your complete blog content here...',

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


@endsection