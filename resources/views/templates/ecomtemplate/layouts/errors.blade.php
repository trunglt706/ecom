<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="{{ url('templates/'.System::template().'/'.System::lang('data.config.logo.favicon')) }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ System::lang('data.config.site_name') }}</title>

        <link href="{{ url('templates/'.( System::template() ).'/css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ url('templates/'.( System::template() ).'/js/jquery.min.js') }}"></script>
        <style media="screen">
            @font-face {
                font-family: 'Roboto Condensed';
                font-style: normal;
                font-weight: normal;
                src: url('{{ url("templates/".( System::template() )."/fonts/RobotoCondensed-webfont.woff") }}') format('woff');
            }

            h1,h2,h3,h4,h5,h6{font-family: 'Roboto Condensed', sans-serif;}
            html, body{
                background: #bdbdbd;
                padding-top: 50px;
            }
            p{
                text-align: justify;
            }
            .panel{
                border: 0px;
                box-shadow: none;
            }
            .panel-title{
                padding: 10px 20px;
                background: #fff;
                border-bottom: 5px solid #0281c3;
            }
            .panel-body{
                background: #f5f5f5 ;
            }
        </style>
    </head>
    <body>
        @yield('main')
    </body>
</html>
