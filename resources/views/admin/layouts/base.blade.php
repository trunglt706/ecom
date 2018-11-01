<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="{{ Path::url('images/favicon.ico') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_SITE_NAME', '') }}</title>

        <link href="{{ Path::url('css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="{{ Path::url('js/jquery.min.js') }}"></script>
        <script src="{{ Path::url('js/bootstrap.min.js') }}"></script>
        @yield('css')
        @yield('jsc')
        <script>
            var errorConnect = function () {
                toastr['error']('{{ \Language::get("global.message_crud_error_connect") }}');
            };
        </script>
    </head>
    <body>
        @yield('main')
        @include(Path::viewAdmin('blocks.changePass'))
        <!--cfmLoader-->
        <div class="modal app-loader" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loader" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="modal-title" style="margin-bottom: 5px;">{{ \Language::get('global.lbl_loading') }}</h4>
                        <div class="progress progress-striped active" style="margin-bottom: 0;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- global notify -->
        <script>
            @if(isset($flash_notify))
                toastr["{{ $flash_notify['status'] }}"]("{{ $flash_notify['message'] }}");
            @endif
        </script>
        @include(Path::viewAdmin('blocks.ajaxError'))
    </body>
</html>
