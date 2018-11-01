<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="{{ Path::urlCurrentTemplate($data['page']->lang, 'images/favicon.ico') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('keywords')
        @yield('description')
        <title>@yield('title')</title>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-70839854-4', 'auto');
			ga('send', 'pageview');
		</script>

        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/material-design-iconic-font.min.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/toastr.min.css') }}" rel="stylesheet">

        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/waves.min.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/sweet-alert.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/lightGallery.css') }}" rel="stylesheet">
        @yield('css')
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/app.min.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/bootstrap-select.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/main.css') }}" rel="stylesheet">
        <link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/font-awesome.min.css') }}" rel="stylesheet">
        @yield('current-css')

        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.min.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/bootstrap.min.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/waves.min.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/bootstrap-growl.min.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/knockout.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/toastr.min.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.validate.min.js') }}"></script>
        @if ($data['page']->lang == 'vi')
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.validate.vi.min.js') }}"></script>
        @endif
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/bootstrap-select.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.canvasjs.min.js') }}"></script>

        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/holder.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/lightGallery.min.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.highlight.js') }}"></script>

        @yield('jsc')
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/functions.js') }}"></script>
        <script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/fn.js') }}"></script>
    </head>
    <body>
        @yield('main')
        <!--cfmLoader-->
        <div id="cfmLoader" class="modal app-loader" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loader" aria-hidden="true">
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
        <div id="back-top">
            <span class="glyphicon glyphicon-arrow-up"></span>
        </div>
        <div class="app-loading">
            <span>
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                <i>{{ \Language::get('global.lbl_loading') }}</i>
            </span>
        </div>
        <script type="text/javascript">
$(document).ajaxError(function () {
    toastr["error"]("<?php echo Language::get('global.message_ajax_error'); ?><br><div class='btn btn-danger' onclick='location.reload()'><?php echo Language::get('global.lbl_reload'); ?></div>");
});
        </script>
    </body>
</html>
