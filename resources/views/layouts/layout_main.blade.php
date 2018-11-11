<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mastermind .:. {{ $title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        @yield('contenido_css')

        <link rel="shortcut icon" href="favicon.ico">
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                @yield('contenido_central')
            </div>
        </div>
        <div class="flex-center position-ref" id="footer">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            &copy; @php echo date('Y'); @endphp :: <span id="site_name">{{ config('app.name') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('contenido_window_on_load')
    </body>
</html>
