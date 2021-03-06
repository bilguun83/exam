<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Fonts -->
  

    <!-- Styles -->
   
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    
    @if (Auth::check())
        @include('inc.navbar')
    @endif
{{-- 
   <div id="app">
       

        <main class="py-4"> --}}
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
        {{-- </main>
    </div> --}}
</body>
</html>
