@extends('Admin.layout.main')

@section('title', 'Add Booking')

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

                        <div class="card-title">
                            Booking Details
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
                              action="{{ route('admin.bookings.store') }}">

                            @csrf


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
                                                    {{ old('property_id') == $property->id ? 'selected' : '' }}>

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

                                        <label for="lead_id">
                                            Lead
                                        </label>


                                        <select id="lead_id"
                                                name="lead_id"
                                                class="form-select @error('lead_id') is-invalid @enderror">

                                            <option value="">
                                                Select Lead
                                            </option>


                                            @foreach ($leads ?? [] as $lead)

                                                <option value="{{ $lead->lead_id }}"
                                                    {{ old('lead_id') == $lead->lead->id ? 'selected' : '' }}>

                                                    {{ $lead->lead->lead_name }}

                                                    @if ($lead->lead->phone)
                                                        - {{ $lead->lead->phone }}
                                                    @endif

                                                </option>

                                            @endforeach

                                        </select>


                                        @error('lead_id')

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
                                               value="{{ old('booking_date') }}"
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
                                                   value="{{ old('amount', 0) }}"
                                                   min="0"
                                                   step="0.01"
                                                   class="form-control @error('amount') is-invalid @enderror"
                                                   placeholder="0.00"
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
                                                {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="confirmed"
                                                {{ old('status') === 'confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>

                                            <option value="cancelled"
                                                {{ old('status') === 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>

                                            <option value="completed"
                                                {{ old('status') === 'completed' ? 'selected' : '' }}>
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
                                                  placeholder="Add booking notes">{{ old('notes') }}</textarea>


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
                                        class="btn btn-success">

                                    <i class="fa fa-save"></i>
                                    Save Booking

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