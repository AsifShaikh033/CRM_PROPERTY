@extends('Admin.layout.main')

@section('title', 'Add Property Visit')

@section('content')
<div class="container"><div class="page-inner">
    <div class="page-header"><h3 class="fw-bold mb-3">Property Visits</h3></div>
    <div class="card">
        <div class="card-header"><div class="card-title">Add Property Visit</div></div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ route('admin.property-visits.store') }}">
                @csrf
                @include('Admin.property-visits._form')
                <div class="card-action">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Visit</button>
                    <a href="{{ route('admin.property-visits.index') }}" class="btn btn-light ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
@endsection
