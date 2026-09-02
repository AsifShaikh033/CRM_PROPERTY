@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Roles</h3>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <div class="d-flex align-items-center">

                            <h4 class="card-title">
                                Roles List
                            </h4>

                            @can('roles.create')

                                <a href="{{ route('admin.roles.create') }}"
                                   class="btn btn-primary btn-round ms-auto">

                                    <i class="fa fa-plus"></i>
                                    Add Role

                                </a>

                            @endcan

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table
                                id="add-row"
                                class="display table table-striped table-hover"
                            >

                                <thead>

                                    <tr>

                                        <th>Role Name</th>

                                        <th>Permissions</th>

                                        <th style="width: 15%">
                                            Action
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($roles as $role)

                                        <tr>

                                            {{-- Role Name --}}
                                            <td>
                                                <strong>
                                                    {{ $role->name }}
                                                </strong>
                                            </td>


                                            {{-- Permissions --}}
                                            <td>

                                                @if($role->name === 'Admin')

                                                    <span class="badge bg-success">
                                                        All Permissions
                                                    </span>

                                                @else

                                                    @forelse($role->permissions as $permission)

                                                        <span class="badge bg-info me-1 mb-1">
                                                            {{ $permission->name }}
                                                        </span>

                                                    @empty

                                                        <span class="text-muted">
                                                            No permissions assigned
                                                        </span>

                                                    @endforelse

                                                @endif

                                            </td>


                                            {{-- Actions --}}
                                            <td>

                                                <div class="form-button-action">

                                                    {{-- Edit --}}
                                                    @can('roles.edit')

                                                        <a
                                                            href="{{ route('admin.roles.edit', $role->id) }}"
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-bs-toggle="tooltip"
                                                            title="Edit Role"
                                                        >

                                                            <i class="fa fa-edit"></i>

                                                        </a>

                                                    @endcan


                                                    {{-- Delete --}}
                                                    @if($role->name !== 'Admin' && $role->name !== 'Agent' 
                                                    && $role->name !== 'Owner'  && $role->name !== 'User') 

                                                        @can('roles.delete')

                                                            <button
                                                                type="button"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal"
                                                                data-id="{{ $role->id }}"
                                                                data-name="{{ $role->name }}"
                                                                class="btn btn-link btn-danger"
                                                                title="Delete Role"
                                                            >

                                                                <i class="fa fa-times"></i>
                                                                {{$role->name}}
                                                            </button>

                                                        @endcan

                                                    @endif

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="3" class="text-center">
                                                No roles found.
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>


{{-- Delete Confirmation Modal --}}
<div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="deleteModalLabel">
                    Confirm Deletion
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body">

                Are you sure you want to delete this role?

                <br>

                <strong id="deleteRoleName"></strong>

                <br><br>

                This action cannot be undone.

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Cancel
                </button>


                <form
                    id="deleteForm"
                    method="POST"
                    style="display:inline;"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
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

    $(document).ready(function() {

        $('#deleteModal').on('show.bs.modal', function (e) {

            // Get role ID
            var roleId = $(e.relatedTarget).data('id');

            // Get role name
            var roleName = $(e.relatedTarget).data('name');


            // Show role name
            $('#deleteRoleName').text(roleName);


            // Set delete form action
            var deleteUrl =
                "{{ url('admin/roles') }}/" + roleId + "/delete";

            $('#deleteForm').attr('action', deleteUrl);

        });

    });

</script>

@endpush