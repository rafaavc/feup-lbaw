<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @if (View::hasSection('title'))
                @yield('title') |
            @endif
            {{ config('app.name', 'Laravel') }}
        </title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>

        <!-- Font Awesome -->
        <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/components/footer.css') }}" rel="stylesheet">
        <link href="{{ asset('css/components/nav.css') }}" rel="stylesheet">
        <link href="{{ asset('css/components/navPopups.css') }}" rel="stylesheet">
        @stack('css')

        <script src="{{ asset('js/general.js') }}" type="module"></script>
        <script src="{{ asset('js/navPopups.js') }}" defer></script>
        @stack('js')

        <script type="text/javascript">
            // Fix for Firefox autofocus CSS bug
            // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
        </script>
    </head>
    <body data-root-url="{{ url("") }}" data-csrf-token="{{ csrf_token() }}">
        @include('partials.nav')
        @yield('content')
        @include('partials.footer')
    </body>
</html>
