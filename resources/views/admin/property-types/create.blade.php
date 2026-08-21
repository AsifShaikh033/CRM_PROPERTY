@extends('layouts.admin.app')

@section('title', 'Add Property Type')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="page-title mb-1">
            Add Property Type
        </h1>

        <div class="text-muted">
            Create a new property type
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
    action="{{ route('admin.property-types.store') }}"
>

    @csrf

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
                    value="{{ old('name') }}"
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

                    <option value="active"
                        {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
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


        <div class="mt-4">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Property Type
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