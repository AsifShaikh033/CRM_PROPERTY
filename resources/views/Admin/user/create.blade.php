@extends('Admin.layout.main')

@section('content')

<div class="container">

    <div class="page-inner">

        {{-- Page Header --}}
        <div class="page-header">

            <h3 class="fw-bold mb-3">
                Add User
            </h3>

        </div>


        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">

                        <div>

                            <h4 class="card-title mb-1">
                                Create New User
                            </h4>

                            <p class="text-muted mb-0">
                                Enter the user details and assign a role.
                            </p>

                        </div>

                    </div>


                    <div class="card-body">

                        {{-- Errors --}}
                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <strong>
                                    Please fix the following errors:
                                </strong>

                                <ul class="mb-0 mt-2">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form
                            action="{{ route('admin.user.store') }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >

                            @csrf


                            <div class="row">


                                {{-- Name --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="name">
                                            First Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="form-control"
                                            value="{{ old('name') }}"
                                            placeholder="Enter first name"
                                            required
                                        >

                                    </div>

                                </div>


                                {{-- Last Name --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="last_name">
                                            Last Name
                                        </label>

                                        <input
                                            type="text"
                                            name="last_name"
                                            id="last_name"
                                            class="form-control"
                                            value="{{ old('last_name') }}"
                                            placeholder="Enter last name"
                                        >

                                    </div>

                                </div>


                                {{-- Email --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="email">
                                            Email
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control"
                                            value="{{ old('email') }}"
                                            placeholder="Enter email address"
                                            required
                                        >

                                    </div>

                                </div>


                                {{-- Mobile --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="mob_number">
                                            Mobile Number
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            name="mob_number"
                                            id="mob_number"
                                            class="form-control"
                                            value="{{ old('mob_number') }}"
                                            placeholder="Enter mobile number"
                                            required
                                        >

                                    </div>

                                </div>


                                {{-- Password --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="password">
                                            Password
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="form-control"
                                            placeholder="Enter password"
                                            required
                                        >

                                        <small class="text-muted">
                                            Minimum 8 characters.
                                        </small>

                                    </div>

                                </div>


                                {{-- Confirm Password --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="password_confirmation">
                                            Confirm Password
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            id="password_confirmation"
                                            class="form-control"
                                            placeholder="Confirm password"
                                            required
                                        >

                                    </div>

                                </div>


                                {{-- Role --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="role">
                                            User Role
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select
                                            name="role"
                                            id="role"
                                            class="form-control"
                                            required
                                        >

                                            <option value="">
                                                Select Role
                                            </option>

                                            @foreach($roles as $role)

                                                <option
                                                    value="{{ $role->name }}"
                                                    {{ old('role') == $role->name ? 'selected' : '' }}
                                                >
                                                    {{ $role->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <small class="text-muted">
                                            The selected role controls the user's permissions.
                                        </small>

                                    </div>

                                </div>


                                {{-- Address --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="address">
                                            Address
                                        </label>

                                        <input
                                            type="text"
                                            name="address"
                                            id="address"
                                            class="form-control"
                                            value="{{ old('address') }}"
                                            placeholder="Enter address"
                                        >

                                    </div>

                                </div>


                                {{-- City --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="city">
                                            City
                                        </label>

                                        <input
                                            type="text"
                                            name="city"
                                            id="city"
                                            class="form-control"
                                            value="{{ old('city') }}"
                                            placeholder="Enter city"
                                        >

                                    </div>

                                </div>


                                {{-- Profile --}}
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="profile">
                                            Profile Image
                                        </label>

                                        <input
                                            type="file"
                                            name="profile"
                                            id="profile"
                                            class="form-control"
                                        >

                                        <small class="text-muted">
                                            JPG, PNG or GIF. Maximum 2MB.
                                        </small>

                                    </div>

                                </div>

                            </div>


                            {{-- Buttons --}}
                            <div class="card-action mt-4">
                                @can('users.create')
                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >

                                    <i class="fa fa-save"></i>

                                    Create User

                                </button>
                                @endcan 


                                <a
                                    href="{{ route('admin.user.list') }}"
                                    class="btn btn-secondary"
                                >

                                    <i class="fa fa-times"></i>

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