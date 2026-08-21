<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Property CRM')
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Admin Theme Variables --}}
    <link
        href="{{ asset('admin/css/variables.css') }}"
        rel="stylesheet"
    >

    {{-- Admin CSS --}}
    <link
        href="{{ asset('admin/css/admin.css') }}"
        rel="stylesheet"
    >

    @stack('styles')

</head>

<body>

    {{-- Sidebar --}}
    @include('layouts.admin.sidebar')


    <div class="admin-main">

        {{-- Header --}}
        @include('layouts.admin.header')


        <main class="admin-content">

            {{-- Success Message --}}
            @if (session('success'))

                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Error Messages --}}
            @if ($errors->any())

                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">

                    <strong>Please fix the following errors:</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- Page Content --}}
            @yield('content')

        </main>

    </div>


    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    {{-- Admin JS --}}
    <script src="{{ asset('admin/js/admin.js') }}"></script>

    @stack('scripts')

</body>

</html>