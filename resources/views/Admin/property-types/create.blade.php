@extends('Admin.layout.main')

@section('title', 'Add Property Type')

@section('content')

<div class="container">
    <div class="page-inner">

        {{-- Page Header --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Property Type Setting</h3>
        </div>


        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    {{-- Card Header --}}
                    <div class="card-header">

                        <div class="card-title">
                            Property Type Details
                        </div>

                        {{-- Validation Errors --}}
                        @if ($errors->any())

                            <div class="alert alert-danger">

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
                              action="{{ route('admin.property-types.store') }}">

                            @csrf


                            <div class="row">


                                {{-- Property Type Name --}}
                                <div class="col-md-6 col-lg-6">

                                    <div class="form-group">

                                        <label for="name">

                                            Property Type Name

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <input type="text"
                                               name="name"
                                               id="name"
                                               value="{{ old('name') }}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="e.g. Apartment, Villa, Office"
                                               required>


                                        @error('name')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div class="col-md-6 col-lg-6">

                                    <div class="form-group">

                                        <label for="status">

                                            Status

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>


                                        <select name="status"
                                                id="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>

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


                            </div>


                            {{-- Actions --}}
                            <div class="card-action">

                                <button type="submit"
                                        class="btn btn-primary">

                                    <i class="fa fa-save"></i>
                                    Save Property Type

                                </button>


                                <a href="{{ route('admin.property-types.index') }}"
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