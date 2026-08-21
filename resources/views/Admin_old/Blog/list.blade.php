@extends('Admin.layout.main')

@section('content')

@push('styles')

<link
    href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css"
    rel="stylesheet">

@endpush


<div class="container">

    <div class="page-inner">


        <!-- PAGE HEADER -->

        <div class="page-header">

            <h3 class="fw-bold mb-3">
                Blogs
            </h3>

        </div>


        <!-- SUCCESS -->

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        <!-- ERRORS -->

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



        <!-- BLOG LIST -->

        <div class="row">

            <div class="col-md-12">

                <div class="card">


                    <!-- HEADER -->

                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <h4 class="card-title">

                                Blog List

                            </h4>


                            <button
                                class="btn btn-primary btn-round ms-auto"
                                id="addBlogButton">

                                <i class="fa fa-plus"></i>

                                Add Blog

                            </button>

                        </div>

                    </div>



                    <!-- BODY -->

                    <div class="card-body">

                        <div class="table-responsive">

                            <table
                                id="add-row"
                                class="display table table-striped table-hover">

                                <thead>

                                    <tr>

                                        <th>
                                            #
                                        </th>

                                        <th>
                                            Image
                                        </th>

                                        <th>
                                            Title
                                        </th>

                                        <th>
                                            Short Description
                                        </th>

                                        <th>
                                            Author
                                        </th>

                                        <th>
                                            Published
                                        </th>

                                        <th>
                                            Priority
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th style="width: 10%">
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach($blogs as $data)

                                        <tr>


                                            <!-- NUMBER -->

                                            <td>

                                                {{ $loop->iteration }}

                                            </td>



                                            <!-- IMAGE -->

                                            <td>

                                                @if($data->image)

                                                    <img
                                                        src="{{ asset('storage/' . $data->image) }}"
                                                        alt="{{ $data->title }}"
                                                        style="
                                                            width:70px;
                                                            height:50px;
                                                            object-fit:cover;
                                                            border-radius:8px;
                                                        ">

                                                @else

                                                    <span class="text-muted">
                                                        No Image
                                                    </span>

                                                @endif

                                            </td>



                                            <!-- TITLE -->

                                            <td>

                                                <strong>

                                                    {{ $data->title }}

                                                </strong>

                                            </td>



                                            <!-- DESCRIPTION -->

                                            <td>

                                                {{ Str::limit(
                                                    $data->short_description,
                                                    80
                                                ) }}

                                            </td>



                                            <!-- AUTHOR -->

                                            <td>

                                                {{ $data->author ?: '-' }}

                                            </td>



                                            <!-- PUBLISHED -->

                                            <td>

                                                @if($data->published_at)

                                                    {{ $data->published_at->format('d M Y') }}

                                                @else

                                                    -

                                                @endif

                                            </td>



                                            <!-- PRIORITY -->

                                            <td>

                                                <span class="badge bg-info">

                                                    {{ $data->priority }}

                                                </span>

                                            </td>



                                            <!-- STATUS -->

                                            <td>

                                                @if($data->status == 1)

                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>

                                                @else

                                                    <span class="badge bg-danger">
                                                        Inactive
                                                    </span>

                                                @endif

                                            </td>



                                            <!-- ACTION -->

                                            <td>

                                                <div class="form-button-action">


                                                    <!-- EDIT -->

                                                    <a
                                                        href="{{ route(
                                                            'admin.editBlog',
                                                            $data->id
                                                        ) }}"
                                                        class="btn btn-link btn-primary btn-lg">

                                                        <i class="fa fa-edit"></i>

                                                    </a>



                                                    <!-- DELETE -->

                                                    <button
                                                        type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-id="{{ $data->id }}"
                                                        class="btn btn-link btn-danger">

                                                        <i class="fa fa-times"></i>

                                                    </button>


                                                </div>

                                            </td>


                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- =====================================================
     ADD BLOG MODAL
===================================================== -->

<div
    class="modal fade"
    id="addBlogModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">


            <form
                method="POST"
                action="{{ route('admin.storeBlog') }}"
                enctype="multipart/form-data">

                @csrf


                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Blog
                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>



                <div class="modal-body">

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
                                    placeholder="Enter Blog Title"
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
                                    placeholder="Enter Author Name">

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

                                <small class="text-muted">

                                    Recommended size: 1200 × 700 px

                                </small>

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
                                    class="form-control">

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
                                    maxlength="500"
                                    placeholder="Enter short blog description"></textarea>

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
                                    rows="8"
                                    placeholder="Enter complete blog content"></textarea>

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
                                    class="form-control"
                                    value="0"
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

                                    <option value="1">
                                        Active
                                    </option>

                                    <option value="0">
                                        Inactive
                                    </option>

                                </select>

                            </div>

                        </div>



                        <!-- SEO TITLE -->

                        <div class="col-md-12">

                            <div class="form-group mb-3">

                                <label>
                                    Meta Title
                                </label>

                                <input
                                    type="text"
                                    name="meta_title"
                                    class="form-control"
                                    placeholder="Enter SEO Meta Title">

                            </div>

                        </div>



                        <!-- SEO KEYWORDS -->

                        <div class="col-md-12">

                            <div class="form-group mb-3">

                                <label>
                                    Meta Keywords
                                </label>

                                <textarea
                                    name="meta_keywords"
                                    class="form-control"
                                    rows="2"
                                    placeholder="keyword 1, keyword 2, keyword 3"></textarea>

                            </div>

                        </div>



                        <!-- SEO DESCRIPTION -->

                        <div class="col-md-12">

                            <div class="form-group mb-3">

                                <label>
                                    Meta Description
                                </label>

                                <textarea
                                    name="meta_description"
                                    class="form-control"
                                    rows="3"
                                    maxlength="1000"
                                    placeholder="Enter SEO Meta Description"></textarea>

                            </div>

                        </div>


                    </div>

                </div>



                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        Save Blog

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>



<!-- =====================================================
     DELETE MODAL
===================================================== -->

<div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">
                    Confirm Deletion
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body">

                Are you sure you want to delete this Blog?

                <br>

                This action cannot be undone.

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancel

                </button>


                <form
                    id="deleteForm"
                    method="POST"
                    action="{{ route('admin.blog_delete') }}">

                    @csrf

                    @method('DELETE')


                    <input
                        type="hidden"
                        name="id"
                        id="blog_id">


                    <button
                        type="submit"
                        class="btn btn-danger">

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>



@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>


<script>

$(document).ready(function () {


    // Open Add Blog Modal

    $('#addBlogButton').on('click', function () {

        $('#addBlogModal').modal('show');

    });



    // Delete Blog

    $('#deleteModal').on(
        'show.bs.modal',
        function (e) {

            var blogId =
                $(e.relatedTarget).data('id');

            $(this)
                .find('#blog_id')
                .val(blogId);

        }
    );



    // Summernote

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