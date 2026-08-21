@extends('Admin.layout.main')

@section('title', 'Add Property')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Property Setting</h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Property Details</div>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3 mb-0">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.properties.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Property Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter property name" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="property_code">Property Code <span class="text-danger">*</span></label>
                                        <input type="text" id="property_code" name="property_code" value="{{ old('property_code') }}" class="form-control @error('property_code') is-invalid @enderror" placeholder="PROP-001" required>
                                        @error('property_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="property_type_id">Property Type <span class="text-danger">*</span></label>
                                        <select id="property_type_id" name="property_type_id" class="form-select @error('property_type_id') is-invalid @enderror" required>
                                            <option value="">Select Property Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}" {{ old('property_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('property_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="owner_id">Property Owner</label>
                                        <select id="owner_id" name="owner_id" class="form-select @error('owner_id') is-invalid @enderror">
                                            <option value="">Select Owner</option>
                                            @foreach ($owners as $owner)
                                                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('owner_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3"><div class="form-group"><label for="phone">Phone</label><input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Owner phone"></div></div>
                                <div class="col-md-3 col-lg-3"><div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Owner email"></div></div>

                                <div class="col-md-12">
                                    <div class="form-group"><label for="address">Address</label><textarea id="address" name="address" rows="3" class="form-control" placeholder="Enter property address">{{ old('address') }}</textarea></div>
                                </div>

                                <div class="col-md-4"><div class="form-group"><label for="city">City</label><input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control" placeholder="City"></div></div>
                                <div class="col-md-4"><div class="form-group"><label for="state">State</label><input type="text" id="state" name="state" value="{{ old('state') }}" class="form-control" placeholder="State"></div></div>
                                <div class="col-md-4"><div class="form-group"><label for="country">Country</label><input type="text" id="country" name="country" value="{{ old('country', 'India') }}" class="form-control" placeholder="Country"></div></div>

                                <div class="col-md-4">
                                    <div class="form-group"><label for="total_units">Total Units <span class="text-danger">*</span></label><input type="number" min="1" id="total_units" name="total_units" value="{{ old('total_units', 1) }}" class="form-control @error('total_units') is-invalid @enderror">@error('total_units') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"><label for="monthly_rent">Monthly Rent</label><input type="number" min="0" step="0.01" id="monthly_rent" name="monthly_rent" value="{{ old('monthly_rent', 0) }}" class="form-control @error('monthly_rent') is-invalid @enderror" placeholder="0.00">@error('monthly_rent') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"><label for="status">Status <span class="text-danger">*</span></label><select id="status" name="status" class="form-select" required><option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option><option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option><option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option></select></div>
                                </div>

                                <div class="col-md-12"><div class="form-group"><label for="description">Description</label><textarea id="description" name="description" rows="5" class="form-control" placeholder="Enter property description">{{ old('description') }}</textarea></div></div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Property Image</label>
                                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp">
                                        <small class="form-text text-muted">JPG, JPEG, PNG or WEBP. Maximum 4MB.</small>
                                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Save Property</button>
                                <a href="{{ route('admin.properties.index') }}" class="btn btn-light ms-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
