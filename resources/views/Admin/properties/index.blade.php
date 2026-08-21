@extends('Admin.layout.main')
@section('title', 'Properties') 
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Properties</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                   <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">
                                Properties List
                            </h4>
                            <a href="{{ route('admin.properties.create') }}"
                            class="btn btn-primary">
                                + Add Property
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Property</th>
                                        <th>Type</th>
                                        <th>Owner</th>
                                        <th>Units</th>
                                        <th>Rent</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <body>
                                    @foreach($properties as $p)
                                    <tr>
                                        <td><b>{{$p->name}}</b>
                                        <br><small>{{$p->property_code}}</small></td>
                                        <td>{{$p->propertyType?->name}}</td>
                                        <td>{{$p->owner?->name ?? '-'}}</td>
                                        <td>{{$p->total_units}}</td>
                                        <td>₹{{number_format($p->monthly_rent,2)}}</td>
                                        <td>{{$p->status}}</td>
                                       
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{route('admin.properties.show',$p)}}" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.properties.edit',$p) }}" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-id="{{ $p->id }}"
                                                        class="btn btn-link btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1"
     aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    Confirm Deletion
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this property?
                This action cannot be undone.
            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <form id="deleteForm"
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

        $('#deleteModal').on('show.bs.modal', function (e) {

            var propertyId = $(e.relatedTarget).data('id');

            var deleteUrl = "{{ url('admin/properties') }}/" + propertyId;

            $('#deleteForm').attr('action', deleteUrl);

        });

    });
</script>
@endpush
