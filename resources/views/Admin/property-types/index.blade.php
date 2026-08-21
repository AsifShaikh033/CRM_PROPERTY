@extends('Admin.layout.main')

@section('title', 'Property Types')

@section('content')

<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Property Types</h3>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">

                        <div class="d-flex align-items-center justify-content-between">

                            <h4 class="card-title mb-0">
                                Property Types List
                            </h4>

                            <a href="{{ route('admin.property-types.create') }}"
                               class="btn btn-primary">

                                <i class="fa fa-plus"></i>
                                Add Property Type

                            </a>

                        </div>

                    </div>


                    {{-- Card Body --}}
                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="add-row"
                                   class="display table table-striped table-hover">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Property Type</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th style="width: 15%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @forelse($items as $item)

                                        <tr>

                                            {{-- ID --}}
                                            <td>
                                                {{ $item->id }}
                                            </td>


                                            {{-- Property Type --}}
                                            <td>
                                                <strong>
                                                    {{ $item->name }}
                                                </strong>
                                            </td>


                                            {{-- Status --}}
                                            <td>

                                                @if($item->status === 'active')

                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>

                                                @else

                                                    <span class="badge bg-secondary">
                                                        Inactive
                                                    </span>

                                                @endif

                                            </td>


                                            {{-- Created --}}
                                            <td>
                                                {{ $item->created_at?->format('d M Y') ?? '-' }}
                                            </td>


                                            {{-- Actions --}}
                                            <td>

                                                <div class="form-button-action">

                                                    {{-- Edit --}}
                                                    <a href="{{ route('admin.property-types.edit', $item->id) }}"
                                                       class="btn btn-link btn-primary btn-lg"
                                                       title="Edit">

                                                        <i class="fa fa-edit"></i>

                                                    </a>


                                                    {{-- Delete --}}
                                                    <button type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deletePropertyTypeModal"
                                                            data-id="{{ $item->id }}"
                                                            class="btn btn-link btn-danger"
                                                            title="Delete">

                                                        <i class="fa fa-times"></i>

                                                    </button>

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5"
                                                class="text-center">

                                                No property types found.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>


{{-- Delete Confirmation Modal --}}
<div class="modal fade"
     id="deletePropertyTypeModal"
     tabindex="-1"
     aria-labelledby="deletePropertyTypeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="deletePropertyTypeModalLabel">

                    Confirm Deletion

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <div class="modal-body">

                Are you sure you want to delete this property type?
                This action cannot be undone.

            </div>


            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Cancel

                </button>


                <form id="deletePropertyTypeForm"
                      method="POST"
                      action=""
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger">

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

    $(document).ready(function () {

        /*
        |--------------------------------------------------------------------------
        | Delete Property Type Modal
        |--------------------------------------------------------------------------
        */

        $('#deletePropertyTypeModal').on('show.bs.modal', function (e) {

            var propertyTypeId = $(e.relatedTarget).data('id');

            var deleteUrl =
                "{{ url('admin/property-types') }}/" + propertyTypeId;

            $('#deletePropertyTypeForm').attr('action', deleteUrl);

        });

    });

</script>

@endpush