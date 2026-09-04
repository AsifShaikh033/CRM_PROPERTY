@extends('Admin.layout.main')

@section('title', 'Edit Property Visit')

@section('content')
<div class="container"><div class="page-inner">
    <div class="page-header"><h3 class="fw-bold mb-3">Property Visits</h3></div>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div class="card-title">Edit Property Visit</div>
            <a href="{{ route('admin.property-visits.show', $item) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> View Visit</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form method="POST" action="{{ route('admin.property-visits.update', $item) }}">
                @csrf @method('PUT')
                @include('Admin.property-visits._form', ['item' => $item])
                <div class="card-action">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Visit</button>
                    <a href="{{ route('admin.property-visits.index') }}" class="btn btn-light ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div></div>
@endsection
