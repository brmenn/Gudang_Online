<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gudang Online') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:flex-row">
            <div class="hidden sm:block sm:w-1/2 lg:w-3/5 bg-gradient-to-br from-primary-600 via-primary-700 to-dark-900 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-10 left-10 w-40 h-40 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-20 right-10 w-60 h-60 bg-primary-300 rounded-full blur-3xl"></div>
                </div>
                <div class="relative h-full flex flex-col justify-center px-12 lg:px-16">
                    <x-application-logo class="mb-8 text-white" />
                    <h1 class="text-3xl lg:text-4xl font-bold text-white leading-tight mb-4">Kelola Gudang<br>Lebih Mudah</h1>
                    <p class="text-primary-100 text-sm lg:text-base max-w-md leading-relaxed">
                        Sistem manajemen inventaris yang terintegrasi untuk mengelola barang, stok masuk, stok keluar, dan supplier dalam satu platform.
                    </p>
                    <div class="mt-8 flex items-center gap-4 text-primary-200 text-xs">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Manajemen Stok
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            API Integration
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Multi User
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col justify-center items-center px-6 py-8 sm:py-0 bg-white">
                <div class="w-full max-w-sm">
                    <div class="sm:hidden mb-8 text-center">
                        <x-application-logo class="justify-center" />
                    </div>
                    <div class="sm:hidden text-center mb-8">
                        <h2 class="text-xl font-bold text-dark-900">Kelola Gudang Lebih Mudah</h2>
                        <p class="text-sm text-dark-500 mt-1">Masuk ke akun Anda</p>
                    </div>
                    <div class="w-full">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
