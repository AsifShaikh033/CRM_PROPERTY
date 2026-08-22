@extends('Admin.layout.main')

@section('title', 'Edit Booking')

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
            <div class="col-md-12">

                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="card-title mb-0">
                                Booking Details
                            </div>

                            <a href="{{ route('admin.bookings.show', ['booking' => $item->id]) }}"
                               class="btn btn-outline-primary">

                                <i class="fa fa-eye"></i>
                                View Booking

                            </a>

                        </div>


                        {{-- Validation Errors --}}
                        @if ($errors->any())

                            <div class="alert alert-danger mt-3 mb-0">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif

                    </div>


                    {{-- Card Body --}}
                    <div class="card-body">

                        <form method="POST"
                              action="{{ route('admin.bookings.update', ['booking' => $item->id]) }}">

                            @csrf

                            @method('PUT')


                            <div class="row">


                                {{-- Property --}}
                                <div class="col-md-6 col-lg-6">

                                    <div class="form-group">

                                        <label for="property_id">
                                            Property
                                        </label>


                                        <select id="property_id"
                                                name="property_id"
                                                class="form-select @error('property_id') is-invalid @enderror">

                                            <option value="">
                                                Select Property
                                            </option>


                                            @foreach ($properties ?? [] as $property)

                                                <option value="{{ $property->id }}"
                                                    {{ old('property_id', $item->property_id) == $property->id ? 'selected' : '' }}>

                                                    {{ $property->name }}

                                                    @if ($property->property_code)
                                                        ({{ $property->property_code }})
                                                    @endif

                                                </option>

                                            @endforeach

                                        </select>


                                        @error('property_id')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- Tenant --}}
                                <div class="col-md-6 col-lg-6">

                                    <div class="form-group">

                                        <label for="tenant_id">
                                            Tenant / Customer
                                        </label>


                                        <select id="tenant_id"
                                                name="tenant_id"
                                                class="form-select @error('tenant_id') is-invalid @enderror">

                                            <option value="">
                                                Select Tenant / Customer
                                            </option>


                                            @foreach ($tenants ?? [] as $tenant)

                                                <option value="{{ $tenant->id }}"
                                                    {{ old('tenant_id', $item->tenant_id) == $tenant->id ? 'selected' : '' }}>

                                                    {{ $tenant->name }}

                                                    @if ($tenant->phone)
                                                        - {{ $tenant->phone }}
                                                    @endif

                                                </option>

                                            @endforeach

                                        </select>


                                        @error('tenant_id')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- Booking Date --}}
                                <div class="col-md-6 col-lg-6">

                                    <div class="form-group">

                                        <label for="booking_date">

                                            Booking Date & Time

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <input type="datetime-local"
                                               id="booking_date"
                                               name="booking_date"
                                               value="{{ old('booking_date', $item->booking_date ? \Carbon\Carbon::parse($item->booking_date)->format('Y-m-d\TH:i') : '') }}"
                                               class="form-control @error('booking_date') is-invalid @enderror"
                                               required>


                                        @error('booking_date')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- Booking Amount --}}
                                <div class="col-md-3 col-lg-3">

                                    <div class="form-group">

                                        <label for="amount">

                                            Booking Amount

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <div class="input-group">

                                            <span class="input-group-text">
                                                ₹
                                            </span>


                                            <input type="number"
                                                   id="amount"
                                                   name="amount"
                                                   value="{{ old('amount', $item->amount ?? 0) }}"
                                                   min="0"
                                                   step="0.01"
                                                   class="form-control @error('amount') is-invalid @enderror"
                                                   required>

                                        </div>


                                        @error('amount')

                                            <div class="text-danger small mt-1">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div class="col-md-3 col-lg-3">

                                    <div class="form-group">

                                        <label for="status">

                                            Status

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <select id="status"
                                                name="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>

                                            <option value="pending"
                                                {{ old('status', $item->status) === 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="confirmed"
                                                {{ old('status', $item->status) === 'confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>

                                            <option value="cancelled"
                                                {{ old('status', $item->status) === 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>

                                            <option value="completed"
                                                {{ old('status', $item->status) === 'completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>

                                        </select>


                                        @error('status')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- Notes --}}
                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="notes">
                                            Notes
                                        </label>


                                        <textarea id="notes"
                                                  name="notes"
                                                  rows="5"
                                                  class="form-control @error('notes') is-invalid @enderror"
                                                  placeholder="Add booking notes">{{ old('notes', $item->notes) }}</textarea>


                                        @error('notes')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                            </div>


                            {{-- Actions --}}
                            <div class="card-action">

                                <button type="submit"
                                        class="btn btn-primary">

                                    <i class="fa fa-save"></i>
                                    Update Booking

                                </button>


                                <a href="{{ route('admin.bookings.index') }}"
                                   class="btn btn-light ms-2">

                                    Cancel

                                </a>

                            </div>


                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection