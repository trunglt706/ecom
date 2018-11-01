<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="{{ Path::url('images/favicon.ico') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_SITE_NAME') }}</title>

        <link href="{{ Path::url('css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ Path::url('js/jquery.min.js') }}"></script>
        <style media="screen">
            @font-face {
                font-family: 'Roboto Condensed';
                font-style: normal;
                font-weight: normal;
                src: url('{{ Path::url("fonts/RobotoCondensed-webfont.woff") }}') format('woff');
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
                -webkit-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.49);
                -moz-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.49);
                box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.49);
            }
            .panel-title{
                padding: 10px 20px;
                background: #fff;
                border-bottom: 5px solid #0281c3;
            }
            .panel-body{
                background: #f5f5f5 ;
            }
            #warning-icon{
              max-width: 100%;  
            }
        </style>
    </head>
    <body>
        @yield('main')
    </body>
</html>
