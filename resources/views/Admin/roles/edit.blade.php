@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">

        {{-- Page Header --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Role</h3>
        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-danger alert-dismissible fade show">

                <strong>Please fix the following errors:</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <div>

                                <h4 class="card-title mb-1">
                                    Edit Role
                                </h4>

                                <p class="text-muted mb-0">
                                    Update the role name and manage its permissions.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <form
                            action="{{ route('admin.roles.update', $role->id) }}"
                            method="POST"
                        >

                            @csrf


                            {{-- ================================================= --}}
                            {{-- ROLE INFORMATION --}}
                            {{-- ================================================= --}}

                            <div class="mb-4">

                                <h5 class="fw-bold mb-3">

                                    <i class="fas fa-user-shield me-2"></i>

                                    Role Information

                                </h5>


                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label class="fw-bold">

                                                Role Name

                                                <span class="text-danger">*</span>

                                            </label>


                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                value="{{ old('name', $role->name) }}"
                                                placeholder="e.g. Property Manager"
                                                {{ $role->name === 'Admin' ? 'readonly' : '' }}
                                                required
                                            >


                                            @if($role->name === 'Admin')

                                                <small class="text-muted">

                                                    The Admin role name cannot be changed.

                                                </small>

                                            @else

                                                <small class="text-muted">

                                                    Update the role name if required.

                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <hr class="my-4">


                            {{-- ================================================= --}}
                            {{-- PERMISSIONS --}}
                            {{-- ================================================= --}}

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div>

                                    <h5 class="fw-bold mb-1">

                                        <i class="fas fa-key me-2"></i>

                                        Permissions

                                    </h5>

                                    <small class="text-muted">

                                        Select the actions this role is allowed to perform.

                                    </small>

                                </div>


                                {{-- Select / Clear --}}
                                @if($role->name !== 'Admin')

                                    <div>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-primary"
                                            id="selectAll"
                                        >

                                            <i class="fas fa-check-double me-1"></i>

                                            Select All

                                        </button>


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-secondary"
                                            id="deselectAll"
                                        >

                                            <i class="fas fa-times me-1"></i>

                                            Clear All

                                        </button>

                                    </div>

                                @endif

                            </div>


                            {{-- ================================================= --}}
                            {{-- PERMISSION GROUPING --}}
                            {{-- ================================================= --}}

                            @php

                                $permissionGroups = [];

                                foreach ($permissions as $permission) {

                                    $parts = explode('.', $permission->name);

                                    $module = $parts[0];

                                    $action = $parts[1] ?? 'view';

                                    $permissionGroups[$module][] = [
                                        'id' => $permission->id,
                                        'name' => $permission->name,
                                        'action' => $action,
                                    ];
                                }

                            @endphp


                            <div class="row">

                                @foreach($permissionGroups as $module => $modulePermissions)

                                    <div class="col-md-6 col-lg-4 mb-4">

                                        <div class="card border shadow-sm h-100">


                                            {{-- Module Header --}}
                                            <div class="card-header bg-light">

                                                <div class="d-flex justify-content-between align-items-center">

                                                    <h6 class="fw-bold text-capitalize mb-0">

                                                        <i class="fas fa-folder-open me-2"></i>

                                                        {{ str_replace('-', ' ', $module) }}

                                                    </h6>


                                                    {{-- Module Select All --}}
                                                    @if($role->name !== 'Admin')

                                                        <div class="form-check">

                                                            <input
                                                                type="checkbox"
                                                                class="form-check-input module-select"
                                                                data-module="{{ $module }}"
                                                                id="module_{{ $module }}"

                                                                @php
                                                                    $allChecked = true;

                                                                    foreach ($modulePermissions as $modulePermission) {

                                                                        if (!in_array(
                                                                            $modulePermission['name'],
                                                                            $rolePermissions
                                                                        )) {
                                                                            $allChecked = false;
                                                                            break;
                                                                        }

                                                                    }
                                                                @endphp

                                                                @if($allChecked)
                                                                    checked
                                                                @endif
                                                            >

                                                            <label
                                                                class="form-check-label small"
                                                                for="module_{{ $module }}"
                                                            >
                                                                All
                                                            </label>

                                                        </div>

                                                    @else

                                                        <span class="badge bg-success">
                                                            All
                                                        </span>

                                                    @endif

                                                </div>

                                            </div>


                                            {{-- Permission List --}}
                                            <div class="card-body">

                                                @foreach($modulePermissions as $permission)

                                                    <div class="d-flex justify-content-between align-items-center mb-3">


                                                        <label
                                                            class="text-capitalize mb-0"
                                                            for="permission_{{ $permission['id'] }}"
                                                        >

                                                            {{ $permission['action'] }}

                                                        </label>


                                                        <div class="form-check form-switch">

                                                            <input
                                                                type="checkbox"
                                                                class="form-check-input permission-checkbox module-{{ $module }}"
                                                                name="permissions[]"
                                                                value="{{ $permission['name'] }}"
                                                                id="permission_{{ $permission['id'] }}"

                                                                @if(
                                                                    $role->name === 'Admin' ||
                                                                    in_array(
                                                                        $permission['name'],
                                                                        $rolePermissions
                                                                    )
                                                                )
                                                                    checked
                                                                @endif

                                                                {{ $role->name === 'Admin' ? 'disabled' : '' }}
                                                            >

                                                        </div>

                                                    </div>

                                                @endforeach

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            {{-- ================================================= --}}
                            {{-- ADMIN NOTICE --}}
                            {{-- ================================================= --}}

                            @if($role->name === 'Admin')

                                <div class="alert alert-info">

                                    <div class="d-flex align-items-center">

                                        <i class="fas fa-info-circle fs-4 me-3"></i>

                                        <div>

                                            <strong>Admin Role</strong>

                                            <div>
                                                Admin has access to all system permissions.
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- ================================================= --}}
                            {{-- ACTION BUTTONS --}}
                            {{-- ================================================= --}}

                            <hr class="my-4">


                            <div class="d-flex justify-content-end gap-2">

                                <a
                                    href="{{ route('admin.roles.index') }}"
                                    class="btn btn-secondary"
                                >

                                    <i class="fas fa-times me-1"></i>

                                    Cancel

                                </a>


                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >

                                    <i class="fas fa-save me-1"></i>

                                    Update Role

                                </button>

                            </div>


                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>


{{-- ================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ================================================= --}}

@push('scripts')

<script>

$(document).ready(function () {


    /*
    |--------------------------------------------------------------------------
    | Select All Permissions
    |--------------------------------------------------------------------------
    */

    $('#selectAll').on('click', function () {

        $('.permission-checkbox').prop('checked', true);

        $('.module-select').prop('checked', true);

    });


    /*
    |--------------------------------------------------------------------------
    | Clear All Permissions
    |--------------------------------------------------------------------------
    */

    $('#deselectAll').on('click', function () {

        $('.permission-checkbox').prop('checked', false);

        $('.module-select').prop('checked', false);

    });


    /*
    |--------------------------------------------------------------------------
    | Select / Unselect Module
    |--------------------------------------------------------------------------
    */

    $('.module-select').on('change', function () {

        let module = $(this).data('module');

        $('.module-' + module).prop(
            'checked',
            $(this).is(':checked')
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Automatically Update Module Checkbox
    |--------------------------------------------------------------------------
    */

    $('.permission-checkbox').on('change', function () {

        let classes = $(this).attr('class').split(' ');

        let moduleClass = classes.find(function (item) {

            return item.startsWith('module-');

        });


        if (moduleClass) {

            let module = moduleClass.replace('module-', '');

            let total = $('.module-' + module).length;

            let checked = $('.module-' + module + ':checked').length;

            $('#module_' + module).prop(
                'checked',
                total === checked
            );

        }

    });

});

</script>

@endpush

@endsection