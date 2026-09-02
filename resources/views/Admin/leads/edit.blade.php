@extends('Admin.layout.main')
@section('title', 'Edit Lead')
@section('content')
<div class="container"><div class="page-inner"><div class="page-header"><h3 class="fw-bold mb-3">Edit Lead</h3></div><div class="card"><div class="card-header"><div class="card-title">Lead Details</div></div><div class="card-body"><form method="POST" action="{{ route('admin.leads.update', $lead) }}">@csrf @method('PUT') @include('Admin.leads._form')<div class="card-action"><button class="btn btn-success">Update Lead</button><a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-light">Cancel</a></div></form></div></div></div></div>
@endsection
