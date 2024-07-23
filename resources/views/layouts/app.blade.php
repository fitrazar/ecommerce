<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="title" content="{{ $__env->yieldContent('title') }}" />
    <meta name="description"
        content="{{ !empty(trim($__env->yieldContent('description'))) ? $__env->yieldContent('description') : '-' }}" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://domain.com/" />
    <meta property="og:title" content="{{ $__env->yieldContent('title') }}" />
    <meta property="og:description"
        content="{{ !empty(trim($__env->yieldContent('description'))) ? $__env->yieldContent('description') : '-' }}" />
    <meta property="og:image"
        content="{{ !empty(trim($__env->yieldContent('image'))) ? $__env->yieldContent('image') : asset('assets/images/logo.png') }}" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://domain.com/" />
    <meta property="twitter:title" content="{{ $__env->yieldContent('title') }}" />
    <meta property="twitter:description"
        content="{{ !empty(trim($__env->yieldContent('description'))) ? $__env->yieldContent('description') : '-' }}" />
    <meta property="twitter:image"
        content="{{ !empty(trim($__env->yieldContent('image'))) ? $__env->yieldContent('image') : asset('assets/images/logo.png') }}" />

    <title>@yield('title', config('app.name', 'Laravel')) - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTableTailwind.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
                document.querySelector('.theme-controller').checked = savedTheme === 'dark';
            }
        });
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins antialiased">
    <div class="min-h-screen bg-base-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        {{-- @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset --}}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/js/all.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/js/solid.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/js/brands.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/js/fontawesome.js') }}"></script>
    <script src="{{ asset('assets/js/dataTable.js') }}"></script>
    <script src="{{ asset('assets/js/dataTableTailwind.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        new DataTable('#myTable');
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        document.querySelector('.theme-controller').addEventListener('change', function() {
            const theme = this.checked ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        });
    </script>
    @if (isset($script))
        {{ $script }}
    @endif
</body>

</html>
