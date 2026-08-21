@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="page-title mb-1">
            Dashboard
        </h1>

        <div class="text-muted">
            Property management overview
        </div>
    </div>

    <div>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
            + Add Property
        </a>
    </div>

</div>


<div class="row g-3">

    {{-- Total Properties --}}
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card">
            <div class="text-muted">
                Properties
            </div>

            <div class="stat-number">
                {{ $totalProperties }}
            </div>
        </div>
    </div>


    {{-- Active Properties --}}
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card">
            <div class="text-muted">
                Active
            </div>

            <div class="stat-number">
                {{ $activeProperties }}
            </div>
        </div>
    </div>


    {{-- Total Units --}}
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card">
            <div class="text-muted">
                Units
            </div>

            <div class="stat-number">
                {{ $totalUnits }}
            </div>
        </div>
    </div>


    {{-- Tenants --}}
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card">
            <div class="text-muted">
                Tenants
            </div>

            <div class="stat-number">
                {{ $totalTenants }}
            </div>
        </div>
    </div>


    {{-- Monthly Collection --}}
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card">
            <div class="text-muted">
                Collected
            </div>

            <div class="stat-number">
                ₹{{ number_format($monthlyCollected, 2) }}
            </div>
        </div>
    </div>


    {{-- Maintenance --}}
    <div class="col-md-6 col-xl-2">
        <div class="card stat-card">
            <div class="text-muted">
                Maintenance
            </div>

            <div class="stat-number">
                {{ $openMaintenance }}
            </div>
        </div>
    </div>

</div>

@endsection