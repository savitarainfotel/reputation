<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    </head>
    <body>
        <div>
            @include('layouts.navigation')
            <!-- Page Content -->
            <main>
                <div class="container-fluid">
                    <!-- Page Heading -->
                    @isset($header)
                        {{ $header }}
                    @endisset

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>