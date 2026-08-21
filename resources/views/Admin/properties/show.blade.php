@extends('Admin.layout.main')

@section('title', $property->name)

@section('content')

<div class="container">
    <div class="page-inner">

        {{-- Page Header --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Property Setting</h3>
        </div>


        <div class="row">

            {{-- Property Details --}}
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="card-title mb-0">
                                Property Details
                            </div>

                            {{-- Status --}}
                            @if($property->status === 'active')

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @elseif($property->status === 'draft')

                                <span class="badge bg-warning text-dark">
                                    Draft
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="row">


                            {{-- Property Name --}}
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">

                                    <label>
                                        Property Name
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->name ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Property Code --}}
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">

                                    <label>
                                        Property Code
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->property_code ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Property Type --}}
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">

                                    <label>
                                        Property Type
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->propertyType?->name ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Property Owner --}}
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">

                                    <label>
                                        Property Owner
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->owner?->name ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Phone --}}
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">

                                    <label>
                                        Phone
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->phone ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Email --}}
                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">

                                    <label>
                                        Email
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->email ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Address --}}
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">

                                    <label>
                                        Address
                                    </label>

                                    <div class="form-control bg-light"
                                         style="min-height: 70px; height: auto;">
                                        {{ $property->address ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- City --}}
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>
                                        City
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->city ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- State --}}
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>
                                        State
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->state ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Country --}}
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>
                                        Country
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->country ?? '-' }}
                                    </div>

                                </div>
                            </div>


                            {{-- Total Units --}}
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>
                                        Total Units
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ $property->total_units ?? 0 }}
                                    </div>

                                </div>
                            </div>


                            {{-- Monthly Rent --}}
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>
                                        Monthly Rent
                                    </label>

                                    <div class="form-control bg-light">
                                        ₹{{ number_format($property->monthly_rent ?? 0, 2) }}
                                    </div>

                                </div>
                            </div>


                            {{-- Status --}}
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">

                                    <label>
                                        Status
                                    </label>

                                    <div class="form-control bg-light">
                                        {{ ucfirst($property->status ?? '-') }}
                                    </div>

                                </div>
                            </div>


                            {{-- Description --}}
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">

                                    <label>
                                        Description
                                    </label>

                                    <div class="form-control bg-light"
                                         style="min-height: 120px; height: auto;">
                                        {{ $property->description ?? 'No description available.' }}
                                    </div>

                                </div>
                            </div>


                        </div>


                        {{-- Actions --}}
                        <div class="card-action">

                            <a href="{{ route('admin.properties.edit', $property->id) }}"
                               class="btn btn-primary">

                                <i class="fa fa-edit"></i>
                                Edit Property

                            </a>


                            <a href="{{ route('admin.properties.index') }}"
                               class="btn btn-light ms-2">

                                Cancel

                            </a>


                            <form action="{{ route('admin.properties.destroy', $property->id) }}"
                                  method="POST"
                                  class="d-inline ms-2"
                                  onsubmit="return confirm('Are you sure you want to delete this property?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger">

                                    <i class="fa fa-trash"></i>
                                    Delete Property

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Property Image --}}
            <div class="col-md-4">

                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            Property Image
                        </div>

                    </div>


                    <div class="card-body">

                        @if($property->image)

                            <img src="{{ asset('storage/' . $property->image) }}"
                                 alt="{{ $property->name }}"
                                 class="img-fluid rounded"
                                 style="width: 100%; max-height: 400px; object-fit: cover;">

                        @else

                            <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                 style="height: 300px;">

                                <div class="text-center text-muted">

                                    <i class="fa fa-home"
                                       style="font-size: 50px;">
                                    </i>

                                    <p class="mt-3 mb-0">
                                        No image available
                                    </p>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- Property Summary --}}
                <div class="card">

                    <div class="card-header">

                        <div class="card-title">
                            Property Summary
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Property Code
                            </span>

                            <strong>
                                {{ $property->property_code ?? '-' }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Total Units
                            </span>

                            <strong>
                                {{ $property->total_units ?? 0 }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Monthly Rent
                            </span>

                            <strong>
                                ₹{{ number_format($property->monthly_rent ?? 0, 2) }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between">

                            <span class="text-muted">
                                Status
                            </span>

                            <strong>
                                {{ ucfirst($property->status ?? '-') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection