@extends('layouts.admin.app')

@section('title', 'Edit Property')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="page-title mb-1">
            Edit Property
        </h1>

        <div class="text-muted">
            Update property information
        </div>
    </div>

    <div>

        <a
            href="{{ route('admin.properties.show', $property) }}"
            class="btn btn-outline-primary"
        >
            View Property
        </a>

        <a
            href="{{ route('admin.properties.index') }}"
            class="btn btn-light ms-2"
        >
            Back
        </a>

    </div>

</div>


<form
    method="POST"
    action="{{ route('admin.properties.update', $property) }}"
    enctype="multipart/form-data"
>

    @csrf

    @method('PUT')


    <div class="card p-4">

        <div class="row g-3">

            {{-- Property Name --}}
            <div class="col-md-6">

                <label class="form-label">
                    Property Name
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $property->name) }}"
                    class="form-control @error('name') is-invalid @enderror"
                    required
                >

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Property Code --}}
            <div class="col-md-3">

                <label class="form-label">
                    Property Code
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="property_code"
                    value="{{ old('property_code', $property->property_code) }}"
                    class="form-control @error('property_code') is-invalid @enderror"
                    required
                >

                @error('property_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Property Type --}}
            <div class="col-md-3">

                <label class="form-label">
                    Property Type
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="property_type_id"
                    class="form-select @error('property_type_id') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Select Property Type
                    </option>

                    @foreach ($types as $type)

                        <option
                            value="{{ $type->id }}"
                            {{ old('property_type_id', $property->property_type_id) == $type->id ? 'selected' : '' }}
                        >
                            {{ $type->name }}
                        </option>

                    @endforeach

                </select>

                @error('property_type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Owner --}}
            <div class="col-md-6">

                <label class="form-label">
                    Property Owner
                </label>

                <select
                    name="owner_id"
                    class="form-select @error('owner_id') is-invalid @enderror"
                >

                    <option value="">
                        Select Owner
                    </option>

                    @foreach ($owners as $owner)

                        <option
                            value="{{ $owner->id }}"
                            {{ old('owner_id', $property->owner_id) == $owner->id ? 'selected' : '' }}
                        >
                            {{ $owner->name }}
                        </option>

                    @endforeach

                </select>

                @error('owner_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Phone --}}
            <div class="col-md-3">

                <label class="form-label">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $property->phone) }}"
                    class="form-control"
                >

            </div>


            {{-- Email --}}
            <div class="col-md-3">

                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $property->email) }}"
                    class="form-control @error('email') is-invalid @enderror"
                >

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Address --}}
            <div class="col-md-12">

                <label class="form-label">
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    class="form-control"
                >{{ old('address', $property->address) }}</textarea>

            </div>


            {{-- City --}}
            <div class="col-md-4">

                <label class="form-label">
                    City
                </label>

                <input
                    type="text"
                    name="city"
                    value="{{ old('city', $property->city) }}"
                    class="form-control"
                >

            </div>


            {{-- State --}}
            <div class="col-md-4">

                <label class="form-label">
                    State
                </label>

                <input
                    type="text"
                    name="state"
                    value="{{ old('state', $property->state) }}"
                    class="form-control"
                >

            </div>


            {{-- Country --}}
            <div class="col-md-4">

                <label class="form-label">
                    Country
                </label>

                <input
                    type="text"
                    name="country"
                    value="{{ old('country', $property->country ?? 'India') }}"
                    class="form-control"
                >

            </div>


            {{-- Total Units --}}
            <div class="col-md-4">

                <label class="form-label">
                    Total Units
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="number"
                    min="1"
                    name="total_units"
                    value="{{ old('total_units', $property->total_units) }}"
                    class="form-control @error('total_units') is-invalid @enderror"
                    required
                >

                @error('total_units')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Monthly Rent --}}
            <div class="col-md-4">

                <label class="form-label">
                    Monthly Rent
                </label>

                <input
                    type="number"
                    min="0"
                    step="0.01"
                    name="monthly_rent"
                    value="{{ old('monthly_rent', $property->monthly_rent) }}"
                    class="form-control @error('monthly_rent') is-invalid @enderror"
                >

                @error('monthly_rent')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- Status --}}
            <div class="col-md-4">

                <label class="form-label">
                    Status
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="status"
                    class="form-select"
                    required
                >

                    <option
                        value="active"
                        {{ old('status', $property->status) == 'active' ? 'selected' : '' }}
                    >
                        Active
                    </option>

                    <option
                        value="draft"
                        {{ old('status', $property->status) == 'draft' ? 'selected' : '' }}
                    >
                        Draft
                    </option>

                    <option
                        value="inactive"
                        {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}
                    >
                        Inactive
                    </option>

                </select>

            </div>


            {{-- Description --}}
            <div class="col-md-12">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="form-control"
                >{{ old('description', $property->description) }}</textarea>

            </div>


            {{-- Current Image --}}
            @if ($property->image)

                <div class="col-md-12">

                    <label class="form-label">
                        Current Image
                    </label>

                    <div>

                        <img
                            src="{{ asset('storage/' . $property->image) }}"
                            alt="{{ $property->name }}"
                            class="rounded border"
                            style="max-width: 220px; max-height: 160px; object-fit: cover;"
                        >

                    </div>

                </div>

            @endif


            {{-- New Image --}}
            <div class="col-md-12">

                <label class="form-label">
                    Change Property Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control @error('image') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg,image/webp"
                >

                <small class="text-muted">
                    Leave empty to keep the current image.
                    JPG, JPEG, PNG or WEBP. Maximum 4MB.
                </small>

                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        {{-- Buttons --}}
        <div class="mt-4 pt-3 border-top">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Property
            </button>

            <a
                href="{{ route('admin.properties.index') }}"
                class="btn btn-light ms-2"
            >
                Cancel
            </a>

        </div>

    </div>

</form>

@endsection