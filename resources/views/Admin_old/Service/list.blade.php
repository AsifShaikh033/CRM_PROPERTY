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
                Services
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


        <div class="row">

            <div class="col-md-12">

                <div class="card">


                    <!-- HEADER -->

                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <h4 class="card-title">
                                Service List
                            </h4>


                            <button
                                class="btn btn-primary btn-round ms-auto"
                                id="addServiceButton">

                                <i class="fa fa-plus"></i>

                                Add Service

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
                                            Icon
                                        </th>

                                        <th>
                                            Title
                                        </th>

                                        <th>
                                            Description
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

                                    @foreach($services as $data)

                                        <tr>

                                            <td>
                                                {{ $loop->iteration }}
                                            </td>


                                            <!-- ICON -->

                                            <td>

                                                @if($data->icon)

                                                    <div
                                                        style="
                                                            width:50px;
                                                            height:50px;
                                                            display:flex;
                                                            align-items:center;
                                                            justify-content:center;
                                                            background:#fde5f0;
                                                            border-radius:12px;
                                                        ">

                                                        <img src="{{ asset('storage/' . $data->icon) }}" alt="{{ $data->title }}" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">

                                                    </div>

                                                @else

                                                    <span class="text-muted">
                                                        No Icon
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

                                                <div
                                                    class="form-button-action">


                                                    <!-- EDIT -->

                                                    <a
                                                        href="{{ route(
                                                            'admin.editService',
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
     ADD SERVICE MODAL
===================================================== -->

<div
    class="modal fade"
    id="addServiceModal"
    tabindex="-1"
    aria-hidden="true">


    <div class="modal-dialog modal-lg">

        <div class="modal-content">


            <form
                method="POST"
                action="{{ route('admin.storeService') }}"
                enctype="multipart/form-data">

                @csrf


                <div class="modal-header">

                    <h5 class="modal-title">

                        Add Service

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

                        <div class="col-md-12">

                            <div class="form-group mb-3">

                                <label>
                                    Service Title
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    placeholder="Enter Service Title"
                                    required>

                            </div>

                        </div>


                        <!-- ICON -->

                        <div class="col-md-12">

                            <div class="form-group mb-3">

                                <label>
                                    Service Icon
                                </label>

                                <input
                                    type="file"
                                    name="icon"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp">

                                <small class="text-muted">

                                    Upload service icon (JPEG, PNG, WebP)

                                </small>

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
                                    placeholder="Enter short service description"></textarea>

                            </div>

                        </div>


                        <!-- DETAILS -->

                        <div class="col-md-12">

                            <div class="form-group mb-3">

                                <label>
                                    Service Details
                                </label>

                                <textarea
                                    name="details" id="service_description"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Enter complete service details"></textarea>

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
                                    min="0"
                                    placeholder="Enter priority">

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

                        Save Service

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

                Are you sure you want to delete this Service?

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
                    action="{{ route('admin.service_delete') }}">

                    @csrf

                    @method('DELETE')


                    <input
                        type="hidden"
                        name="id"
                        id="service_id">


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

<script>

$(document).ready(function () {


    /*
    |--------------------------------------------------------------------------
    | Open Add Service Modal
    |--------------------------------------------------------------------------
    */

    $('#addServiceButton').on('click', function () {

        $('#addServiceModal').modal('show');

    });


    /*
    |--------------------------------------------------------------------------
    | Delete Service
    |--------------------------------------------------------------------------
    */

    $('#deleteModal').on(
        'show.bs.modal',
        function (e) {

            var serviceId =
                $(e.relatedTarget).data('id');

            $(this)
                .find('#service_id')
                .val(serviceId);

        }
    );

});

</script>

@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>

    $(document).ready(function () {

        $('#service_description').summernote({

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

@endsection