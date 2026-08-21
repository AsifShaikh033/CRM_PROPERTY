@extends('layouts.admin.app')

@section('title', $property->name)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1 class="page-title mb-1">
            {{ $property->name }}
        </h1>

        <div class="text-muted">
            Property Code:
            <strong>{{ $property->property_code }}</strong>
        </div>

    </div>


    <div>

        <a
            href="{{ route('admin.properties.edit', $property) }}"
            class="btn btn-primary"
        >
            Edit Property
        </a>

        <a
            href="{{ route('admin.properties.index') }}"
            class="btn btn-light ms-2"
        >
            Back
        </a>

    </div>

</div>


<div class="row g-4">

    {{-- Main Property Information --}}
    <div class="col-lg-8">

        <div class="card p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="mb-0">
                    Property Information
                </h5>

                @if ($property->status === 'active')

                    <span class="badge bg-success">
                        Active
                    </span>

                @elseif ($property->status === 'draft')

                    <span class="badge bg-warning text-dark">
                        Draft
                    </span>

                @else

                    <span class="badge bg-secondary">
                        Inactive
                    </span>

                @endif

            </div>


            <div class="row g-4">

                {{-- Property Type --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Property Type
                    </div>

                    <div class="fw-semibold">
                        {{ $property->propertyType?->name ?? '-' }}
                    </div>

                </div>


                {{-- Owner --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Owner
                    </div>

                    <div class="fw-semibold">
                        {{ $property->owner?->name ?? '-' }}
                    </div>

                </div>


                {{-- Phone --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Phone
                    </div>

                    <div class="fw-semibold">
                        {{ $property->phone ?? '-' }}
                    </div>

                </div>


                {{-- Email --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Email
                    </div>

                    <div class="fw-semibold">
                        {{ $property->email ?? '-' }}
                    </div>

                </div>


                {{-- Total Units --}}
                <div class="col-md-4">

                    <div class="text-muted small">
                        Total Units
                    </div>

                    <div class="fw-semibold fs-5">
                        {{ $property->total_units }}
                    </div>

                </div>


                {{-- Monthly Rent --}}
                <div class="col-md-4">

                    <div class="text-muted small">
                        Monthly Rent
                    </div>

                    <div class="fw-semibold fs-5">
                        ₹{{ number_format($property->monthly_rent, 2) }}
                    </div>

                </div>


                {{-- Country --}}
                <div class="col-md-4">

                    <div class="text-muted small">
                        Country
                    </div>

                    <div class="fw-semibold">
                        {{ $property->country ?? '-' }}
                    </div>

                </div>


                {{-- City --}}
                <div class="col-md-4">

                    <div class="text-muted small">
                        City
                    </div>

                    <div class="fw-semibold">
                        {{ $property->city ?? '-' }}
                    </div>

                </div>


                {{-- State --}}
                <div class="col-md-4">

                    <div class="text-muted small">
                        State
                    </div>

                    <div class="fw-semibold">
                        {{ $property->state ?? '-' }}
                    </div>

                </div>


                {{-- Address --}}
                <div class="col-md-12">

                    <div class="text-muted small">
                        Address
                    </div>

                    <div class="fw-semibold">
                        {{ $property->address ?? '-' }}
                    </div>

                </div>


                {{-- Description --}}
                <div class="col-md-12">

                    <div class="text-muted small">
                        Description
                    </div>

                    <div>
                        {{ $property->description ?? 'No description available.' }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Property Image --}}
    <div class="col-lg-4">

        <div class="card p-3">

            <h5 class="mb-3">
                Property Image
            </h5>


            @if ($property->image)

                <img
                    src="{{ asset('storage/' . $property->image) }}"
                    alt="{{ $property->name }}"
                    class="img-fluid rounded"
                >

            @else

                <div
                    class="bg-light rounded d-flex align-items-center justify-content-center"
                    style="height: 250px;"
                >

                    <div class="text-muted text-center">

                        <div style="font-size: 40px;">
                            🏠
                        </div>

                        No image available

                    </div>

                </div>

            @endif

        </div>


        {{-- Quick Actions --}}
        <div class="card p-4 mt-4">

            <h5 class="mb-3">
                Quick Actions
            </h5>


            <div class="d-grid gap-2">

                <a
                    href="{{ route('admin.properties.units', $property) }}"
                    class="btn btn-outline-primary"
                >
                    Manage Units
                </a>


                <a
                    href="{{ route('admin.properties.edit', $property) }}"
                    class="btn btn-outline-secondary"
                >
                    Edit Property
                </a>


                <form
                    method="POST"
                    action="{{ route('admin.properties.destroy', $property) }}"
                    onsubmit="return confirm('Are you sure you want to delete this property?')"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger w-100"
                    >
                        Delete Property
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- Units --}}
<div class="card p-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h5 class="mb-1">
                Property Units
            </h5>

            <div class="text-muted small">
                Units associated with this property
            </div>

        </div>


        <a
            href="{{ route('admin.properties.units', $property) }}"
            class="btn btn-sm btn-outline-primary"
        >
            View All Units
        </a>

    </div>


    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead>

                <tr>

                    <th>
                        Unit
                    </th>

                    <th>
                        Type
                    </th>

                    <th>
                        Rent
                    </th>

                    <th>
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($property->units as $unit)

                    <tr>

                        <td>
                            <strong>
                                {{ $unit->unit_number }}
                            </strong>
                        </td>

                        <td>
                            {{ $unit->unit_type ?? '-' }}
                        </td>

                        <td>
                            ₹{{ number_format($unit->rent, 2) }}
                        </td>

                        <td>

                            @if ($unit->status === 'available')

                                <span class="badge bg-success">
                                    Available
                                </span>

                            @elseif ($unit->status === 'occupied')

                                <span class="badge bg-primary">
                                    Occupied
                                </span>

                            @elseif ($unit->status === 'maintenance')

                                <span class="badge bg-warning text-dark">
                                    Maintenance
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ ucfirst($unit->status) }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="text-center py-4 text-muted"
                        >
                            No units have been added to this property yet.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection