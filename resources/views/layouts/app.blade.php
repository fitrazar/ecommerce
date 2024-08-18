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
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins antialiased">
    @include('layouts.navigation')

    <!-- Drawer and Sidebar -->
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Hamburger Icon for Mobile View -->
            <div class="flex-none lg:hidden ml-8">
                <label for="my-drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block h-6 w-6 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            <!-- Main Content -->
            <main class="flex-1 p-4">
                {{ $slot }}
            </main>
        </div>

        <!-- Sidebar Content -->
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-slate-100 text-base-content min-h-full w-[250px] p-4">
                @auth
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i> Beranda</a>
                </li>
                <li>
                    <details>
                        <summary> <i class="fas fa-box"></i> Data Product</summary>
                        <ul class="pl-4">
                            <li><a href=" {{ route('product.index') }} ">Product</a></li>
                            <li><a href="{{ route('category.index') }}">Kategori</a></li>
                            <li><a href="{{ route('brand.index') }}">Brand</a></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary> <i class="fas fa-boxes"></i>Data Detail Product</summary>
                        <ul class="pl-4">
                            <li><a href="{{ route('material.index') }}">Bahan</a></li>
                            <li><a href="{{ route('unit.index') }}">Satuan</a></li>
                            <li><a href="{{ route('color.index') }}">Warna</a></li>
                            <li><a href="{{ route('size.index') }}">Ukuran</a></li>
                        </ul>
                    </details>
                </li>
                @else
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="/products">Products</a></li>
                @endauth
            </ul>
        </div>
    </div>

    @include('sweetalert::alert')

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
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
