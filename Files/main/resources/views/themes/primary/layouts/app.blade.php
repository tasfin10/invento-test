<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> {{ $setting->siteName(__($pageTitle)) }}</title>

        <link rel="shortcut icon" href="{{ getImage(getFilePath('logoFavicon').'/favicon.png') }}" type="image/x-icon">

        <link rel="stylesheet" href="{{ asset('assets/universal/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/universal/css/tabler.css') }}">
        <link rel="stylesheet" href="{{ asset($activeThemeTrue . 'css/main.css') }}">

        @stack('page-style-lib')
        @stack('page-style')
    </head>

    <body>
        @yield('content')

        <script src="{{ asset('assets/universal/js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/universal/js/bootstrap.js') }}"></script>

        @include('partials.toasts')

        @stack('page-script-lib')
        @stack('page-script')

        <script>
            (function ($) {
                "use strict";

                Array.from(document.querySelectorAll('table')).forEach(table => {
                    let heading = table.querySelectorAll('thead tr th');
                    Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                        Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                            colum.setAttribute('data-label', heading[i].innerText)
                        });
                    });
                });
            })(jQuery);
        </script>
    </body>
</html>
