@extends('Admin.layout.main')

@section('title', 'Edit Property')

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
                        <div class="card-title">Edit Property Details</div>

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
                        <form method="POST" action="{{ route('admin.properties.update', $property) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Property Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" value="{{ old('name', $property->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="property_code">Property Code <span class="text-danger">*</span></label>
                                        <input type="text" id="property_code" name="property_code" value="{{ old('property_code', $property->property_code) }}" class="form-control @error('property_code') is-invalid @enderror" required>
                                        @error('property_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label for="property_type_id">Property Type <span class="text-danger">*</span></label>
                                        <select id="property_type_id" name="property_type_id" class="form-select @error('property_type_id') is-invalid @enderror" required>
                                            <option value="">Select Property Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}" {{ old('property_type_id', $property->property_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
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
                                                <option value="{{ $owner->id }}" {{ old('owner_id', $property->owner_id) == $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('owner_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3"><div class="form-group"><label for="phone">Phone</label><input type="text" id="phone" name="phone" value="{{ old('phone', $property->phone) }}" class="form-control"></div></div>
                                <div class="col-md-3 col-lg-3"><div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" value="{{ old('email', $property->email) }}" class="form-control @error('email') is-invalid @enderror">@error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror</div></div>

                                <div class="col-md-12"><div class="form-group"><label for="address">Address</label><textarea id="address" name="address" rows="3" class="form-control">{{ old('address', $property->address) }}</textarea></div></div>

                                <div class="col-md-4"><div class="form-group"><label for="city">City</label><input type="text" id="city" name="city" value="{{ old('city', $property->city) }}" class="form-control"></div></div>
                                <div class="col-md-4"><div class="form-group"><label for="state">State</label><input type="text" id="state" name="state" value="{{ old('state', $property->state) }}" class="form-control"></div></div>
                                <div class="col-md-4"><div class="form-group"><label for="country">Country</label><input type="text" id="country" name="country" value="{{ old('country', $property->country ?? 'India') }}" class="form-control"></div></div>

                                <div class="col-md-6">
                                    <div class="form-group"><label for="monthly_rent">Monthly Rent</label><input type="number" min="0" step="0.01" id="monthly_rent" name="monthly_rent" value="{{ old('monthly_rent', $property->monthly_rent) }}" class="form-control @error('monthly_rent') is-invalid @enderror">@error('monthly_rent') <div class="invalid-feedback">{{ $message }}</div> @enderror</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><label for="status">Status <span class="text-danger">*</span></label><select id="status" name="status" class="form-select" required><option value="active" {{ old('status', $property->status) == 'active' ? 'selected' : '' }}>Active</option><option value="draft" {{ old('status', $property->status) == 'draft' ? 'selected' : '' }}>Draft</option><option value="inactive" {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}>Inactive</option></select></div>
                                </div>

                                <div class="col-md-12"><div class="form-group"><label for="description">Description</label><textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $property->description) }}</textarea></div></div>

                                @if ($property->image)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Image</label>
                                            <div><img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->name }}" class="img-fluid rounded border" style="max-width: 220px; max-height: 160px; object-fit: cover;"></div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Change Property Image</label>
                                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp">
                                        <small class="form-text text-muted">Leave empty to keep the current image. JPG, JPEG, PNG or WEBP. Maximum 4MB.</small>
                                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Update Property</button>
                                <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-primary ms-2">View Property</a>
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
