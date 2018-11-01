<nav class="navbar navbar-inverse navbar-fixed-top app-menu">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNavbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand app-title" href="dashboard"><img src="{{ Path::url('images/logo.png') }}"></a>
            <a class="navbar-brand" target="_blank" href="{{ Path::url('/') }}" id="site"><span class="glyphicon glyphicon-new-window"></span></a>
        </div>
        <div id="mainNavbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @include(Path::viewAdmin('blocks.menu'))
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->fullname }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="profile"><span class="glyphicon glyphicon-edit"></span> {{ Language::getCom('system.lbl_group_info_user') }}</a></li>
                        <li><a href="logout"><span class="glyphicon glyphicon-log-out"></span> {{ Language::get('global.lbl_auth_logout') }}</a></li>
                    </ul>
                </li>
            </ul>
          </div><!--/.nav-collapse -->
    </div><!-- /.container-fluid -->
</nav>
