@extends('Admin.layout.main')

@section('title', 'Booking Details')

@section('content')

<div class="container">
    <div class="page-inner">

        {{-- Page Header --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">
                Booking Setting
            </h3>
        </div>


        <div class="row">

            {{-- Booking Details --}}
            <div class="col-md-8">

                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="card-title mb-0">
                                Booking Details
                            </div>


                            {{-- Status --}}
                            @switch($item->status)

                                @case('pending')

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                    @break

                                @case('confirmed')

                                    <span class="badge bg-success">
                                        Confirmed
                                    </span>

                                    @break

                                @case('cancelled')

                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>

                                    @break

                                @case('completed')

                                    <span class="badge bg-primary">
                                        Completed
                                    </span>

                                    @break

                                @default

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($item->status ?? 'Unknown') }}
                                    </span>

                            @endswitch

                        </div>

                    </div>


                    {{-- Card Body --}}
                    <div class="card-body">

                        <div class="row">


                            {{-- Booking ID --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Booking ID
                                    </label>

                                    <div class="form-control bg-light">
                                        #{{ $item->id }}
                                    </div>

                                </div>

                            </div>


                            {{-- Booking Date --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Booking Date & Time
                                    </label>

                                    <div class="form-control bg-light">

                                        {{ $item->booking_date
                                            ? \Carbon\Carbon::parse($item->booking_date)->format('d M Y, h:i A')
                                            : '-'
                                        }}

                                    </div>

                                </div>

                            </div>


                            {{-- Property --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Property
                                    </label>

                                    <div class="form-control bg-light">

                                        @if($item->property)

                                            {{ $item->property->name }}

                                            @if($item->property->property_code)

                                                <small class="text-muted">
                                                    ({{ $item->property->property_code }})
                                                </small>

                                            @endif

                                        @elseif($item->property_id)

                                            Property #{{ $item->property_id }}

                                        @else

                                            -

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- Tenant --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Lead 
                                    </label>

                                    <div class="form-control bg-light">

                                        @if($item->lead_name)

                                            {{ $item->lead_name }}


                                        @else

                                            -

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- Tenant Phone --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Lead Phone
                                    </label>

                                    <div class="form-control bg-light">

                                        {{ $item->lead_phone ?? '-' }}

                                    </div>

                                </div>

                            </div>


                            {{-- Tenant Email --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Lead Email
                                    </label>

                                    <div class="form-control bg-light">

                                        {{ $item->lead_email ?? '-' }}

                                    </div>

                                </div>

                            </div>


                            {{-- Booking Amount --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Booking Amount
                                    </label>

                                    <div class="form-control bg-light">

                                        ₹{{ number_format($item->amount ?? 0, 2) }}

                                    </div>

                                </div>

                            </div>


                            {{-- Status --}}
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">

                                    <label>
                                        Status
                                    </label>

                                    <div class="form-control bg-light">

                                        {{ ucfirst($item->status ?? '-') }}

                                    </div>

                                </div>

                            </div>


                            {{-- Notes --}}
                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Notes
                                    </label>

                                    <div class="form-control bg-light"
                                         style="min-height: 120px; height: auto;">

                                        {{ $item->notes ?? 'No notes available.' }}

                                    </div>

                                </div>

                            </div>


                        </div>


                        {{-- Actions --}}
                        <div class="card-action">

                            <a href="{{ route('admin.bookings.edit', ['booking' => $item->id]) }}"
                               class="btn btn-primary">

                                <i class="fa fa-edit"></i>
                                Edit Booking

                            </a>


                            <a href="{{ route('admin.bookings.index') }}"
                               class="btn btn-light ms-2">

                                Cancel

                            </a>
                            <button type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteBookingModal"
                                    data-id="{{ $item->id }}"
                                    class="btn btn-danger"
                                    title="Delete">

                                <i class="fa fa-trash"></i>
                                Delete Booking

                            </button>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Right Sidebar --}}
            <div class="col-md-4">

                {{-- Record Information --}}
                <div class="card mt-4">

                    <div class="card-header">

                        <div class="card-title">
                            Record Information
                        </div>

                    </div>


                    <div class="card-body">


                        <div class="form-group">

                            <label>
                                Booking ID
                            </label>

                            <div class="form-control bg-light">
                                #{{ $item->id }}
                            </div>

                        </div>


                        <div class="form-group">

                            <label>
                                Created
                            </label>

                            <div class="form-control bg-light">

                                {{ $item->created_at?->format('d M Y, h:i A') ?? '-' }}

                            </div>

                        </div>


                        <div class="form-group mb-0">

                            <label>
                                Last Updated
                            </label>

                            <div class="form-control bg-light">

                                {{ $item->updated_at?->format('d M Y, h:i A') ?? '-' }}

                            </div>

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