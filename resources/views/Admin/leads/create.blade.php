@extends('Admin.layout.main')
@section('title', 'Add Lead')
@section('content')
<div class="container"><div class="page-inner"><div class="page-header"><h3 class="fw-bold mb-3">Add Lead</h3></div><div class="card"><div class="card-header"><div class="card-title">Lead Details</div></div><div class="card-body"><form method="POST" action="{{ route('admin.leads.store') }}">@csrf @include('Admin.leads._form', ['lead' => new \App\Models\Lead])<div class="card-action"><button class="btn btn-success">Save Lead</button><a href="{{ route('admin.leads.index') }}" class="btn btn-light">Cancel</a></div></form></div></div></div></div>
@endsection
