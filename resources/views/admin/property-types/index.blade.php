@extends('layouts.admin.app')

@section('title', 'Property Types')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="page-title mb-1">
            Property Types
        </h1>

        <div class="text-muted">
            Manage property types
        </div>
    </div>

    <div>
        <a
            href="{{ route('admin.property-types.create') }}"
            class="btn btn-primary"
        >
            + Add Property Type
        </a>
    </div>

</div>


<div class="card p-4">

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th>Property Type</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>


            <tbody>

                @forelse ($items as $item)

                    <tr>

                        <td>
                            {{ $item->id }}
                        </td>


                        <td>

                            <strong>
                                {{ $item->name }}
                            </strong>

                        </td>


                        <td>

                            @if ($item->status === 'active')

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </td>


                        <td>

                            {{ $item->created_at?->format('d M Y') }}

                        </td>


                        <td>

                            <a
                                href="{{ route('admin.property-types.edit', $item) }}"
                                class="btn btn-sm btn-outline-primary"
                            >
                                Edit
                            </a>


                            <form
                                action="{{ route('admin.property-types.destroy', $item) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this property type?')"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center py-5"
                        >

                            <div class="text-muted">

                                No property types found.

                            </div>

                            <a
                                href="{{ route('admin.property-types.create') }}"
                                class="btn btn-primary btn-sm mt-3"
                            >
                                + Add Property Type
                            </a>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="mt-3">

        {{ $items->links() }}

    </div>

</div>

@endsection