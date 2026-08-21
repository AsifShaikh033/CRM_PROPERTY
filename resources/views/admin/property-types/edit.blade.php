@extends('layouts.admin.app')

@section('title', 'Edit Property Type')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="page-title mb-1">
            Edit Property Type
        </h1>

        <div class="text-muted">
            Update property type information
        </div>
    </div>

    <a
        href="{{ route('admin.property-types.index') }}"
        class="btn btn-light"
    >
        ← Back
    </a>

</div>


<form
    method="POST"
    action="{{ route('admin.property-types.update', [
        'property_type' => $item->id
    ]) }}"
>

    @csrf

    @method('PUT')


    <div class="card p-4">

        <div class="row g-3">

            {{-- Property Type Name --}}
            <div class="col-md-8">

                <label class="form-label">
                    Property Type Name
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $item->name) }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="e.g. Apartment, Villa, Office"
                    required
                >

                @error('name')

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
                    class="form-select @error('status') is-invalid @enderror"
                    required
                >

                    <option
                        value="active"
                        {{ old('status', $item->status) == 'active' ? 'selected' : '' }}
                    >
                        Active
                    </option>

                    <option
                        value="inactive"
                        {{ old('status', $item->status) == 'inactive' ? 'selected' : '' }}
                    >
                        Inactive
                    </option>

                </select>

                @error('status')

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
                Update Property Type
            </button>

            <a
                href="{{ route('admin.property-types.index') }}"
                class="btn btn-light ms-2"
            >
                Cancel
            </a>

        </div>

    </div>

</form>

@endsection