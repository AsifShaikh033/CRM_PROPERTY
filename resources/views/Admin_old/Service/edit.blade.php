@extends('Admin.layout.main')

@section('content')

<div class="container">

    <div class="page-inner">


        <div class="page-header">

            <h3 class="fw-bold mb-3">
                Service Setting
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

                            Service Details

                        </div>

                    </div>


                    <div class="card-body">


                        <form
                            action="{{ route(
                                'admin.updateService',
                                $Data->id
                            ) }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf


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
                                            value="{{ $Data->title }}"
                                            placeholder="Enter Service Title"
                                            required>

                                    </div>

                                </div>


                                <!-- ICON -->

                                <div class="col-md-12">

                                    <div class="form-group mb-3">

                                        <label>
                                            Bootstrap Icon Class
                                        </label>

                                        <input
                                            type="file"
                                            name="icon"
                                            class="form-control"
                                            accept="image/*">


                                        @if($Data->icon)

                                            <div
                                                class="mt-3"
                                                style="
                                                    width:60px;
                                                    height:60px;
                                                    display:flex;
                                                    align-items:center;
                                                    justify-content:center;
                                                    background:#fde5f0;
                                                    border-radius:12px;
                                                ">
                                                <img src="{{ asset('storage/' . $Data->icon) }}" alt="Icon" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">

                                            </div>

                                        @endif

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
                                            placeholder="Enter Short Description">{{ $Data->short_description }}</textarea>

                                    </div>

                                </div>


                                <!-- DETAILS -->

                                <div class="col-md-12">

                                    <div class="form-group mb-3">

                                        <label>
                                            Service Details
                                        </label>

                                        <textarea
                                            name="details"
                                            id="service_description"
                                            class="form-control"
                                            rows="8"
                                            placeholder="Enter complete service details">{{ $Data->details }}</textarea>

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

                                            <option
                                                value="1"
                                                {{ $Data->status == 1
                                                    ? 'selected'
                                                    : '' }}>

                                                Active

                                            </option>


                                            <option
                                                value="0"
                                                {{ $Data->status == 0
                                                    ? 'selected'
                                                    : '' }}>

                                                Inactive

                                            </option>

                                        </select>

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
                                    href="{{ route(
                                        'admin.service.list'
                                    ) }}"
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