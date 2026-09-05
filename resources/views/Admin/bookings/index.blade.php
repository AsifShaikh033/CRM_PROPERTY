@extends('Admin.layout.main')

@section('title', 'Bookings')

@section('content')

<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Bookings</h3>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <div class="d-flex align-items-center justify-content-between">

                            <h4 class="card-title mb-0">
                                Bookings List
                            </h4>

                            <a href="{{ route('admin.bookings.create') }}"
                               class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Add Booking
                            </a>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="add-row"
                                   class="display table table-striped table-hover">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Property</th>
                                        <th>Lead</th>
                                        <th>Booking Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($items as $item)

                                        <tr>

                                            <td>
                                                {{ $item->id }}
                                            </td>

                                            <td>
                                                @if($item->property)

                                                    <strong>
                                                        {{ $item->property->name }}
                                                    </strong>

                                                    @if($item->property->property_code)
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ $item->property->property_code }}
                                                        </small>
                                                    @endif

                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>
                                                @if($item->lead_name)

                                                    <strong>
                                                        {{ $item->lead_name }}
                                                    </strong>

                                                    @if($item->lead_phone)
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ $item->lead_phone }}
                                                        </small>
                                                    @endif

                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td>
                                                {{ $item->booking_date
                                                    ? \Carbon\Carbon::parse($item->booking_date)->format('d M Y, h:i A')
                                                    : '-'
                                                }}
                                            </td>

                                            <td>
                                                ₹{{ number_format($item->amount ?? 0, 2) }}
                                            </td>

                                            <td>

                                                @if($item->status === 'pending')

                                                    <span class="badge bg-warning text-dark">
                                                        Pending
                                                    </span>

                                                @elseif($item->status === 'confirmed')

                                                    <span class="badge bg-success">
                                                        Confirmed
                                                    </span>

                                                @elseif($item->status === 'cancelled')

                                                    <span class="badge bg-danger">
                                                        Cancelled
                                                    </span>

                                                @elseif($item->status === 'completed')

                                                    <span class="badge bg-primary">
                                                        Completed
                                                    </span>

                                                @else

                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst($item->status ?? 'Unknown') }}
                                                    </span>

                                                @endif

                                            </td>

                                            <td>
                                                {{ $item->created_at?->format('d M Y') ?? '-' }}
                                            </td>

                                            <td>

                                                <div class="form-button-action">

                                                    <a href="{{ route('admin.bookings.show', $item->id) }}"
                                                       class="btn btn-link btn-info btn-lg"
                                                       title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.bookings.edit', $item->id) }}"
                                                       class="btn btn-link btn-primary btn-lg"
                                                       title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <button type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteBookingModal"
                                                            data-id="{{ $item->id }}"
                                                            class="btn btn-link btn-danger"
                                                            title="Delete">
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


{{-- Delete Modal --}}
<div class="modal fade"
     id="deleteBookingModal"
     tabindex="-1"
     aria-labelledby="deleteBookingModalLabel"
     aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="deleteBookingModalLabel">
                    Confirm Deletion
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">
                Are you sure you want to delete this booking?
                This action cannot be undone.
            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <form id="deleteBookingForm"
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

        $('#deleteBookingModal').on('show.bs.modal', function (e) {

            var bookingId = $(e.relatedTarget).data('id');

            var deleteUrl =
                "{{ url('admin/bookings') }}/" + bookingId;

            $('#deleteBookingForm').attr('action', deleteUrl);

        });

    });
</script>

@endpush