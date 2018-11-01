<li class="dropdown">
    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button">{{ \Language::getCom('system.lbl_system') }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li class="">
            <a href="dashboard"><span class="fa fa-server"></span> {{ \Language::getCom('system.lbl_dashboard') }}</a>
        </li>
        @if(Permission::hasPerm('configs', 'CAN_ACCESS'))
        <li class="">
            <a href="configs"><span class="glyphicon glyphicon-cog"></span> {{ \Language::getCom('system.lbl_config') }}</a>
        </li>
        @endif
    </ul>
</li>
@if(Permission::hasPerm('users', 'CAN_ACCESS') || Permission::hasPerm('user-groups', 'CAN_ACCESS'))
<li class="dropdown">
    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button">{{ \Language::getCom('system.lbl_user_manager') }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        @if(Permission::hasPerm('users', 'CAN_ACCESS'))
        <li class="">
            <a href="users"><span class="glyphicon glyphicon-user"></span> {{ \Language::getCom('system.lbl_user') }}</a>
        </li>
        @endif 
        @if(Permission::hasPerm('user-groups', 'CAN_ACCESS'))
        <li class="">
            <a href="user-groups"><span class="fa fa-users"></span> {{ \Language::getCom('system.lbl_usergroup') }}</a>
        </li>
        @endif
    </ul>
</li>
@endif

@foreach(\Extension::Where('public',1)->where('type', 'Plugin')->get() as $plugin)
    @if( Permission::inHasPerm(_Route::Where('extension_id', $plugin->id)->where('show_menu', 1)->lists('alias') , 'CAN_ACCESS') )
        <li class="dropdown">
            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button">{{ \Language::getCom( strtolower($plugin->name).'.lbl_'.strtolower($plugin->name) ) }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                @foreach(\App\Com\System\Route::Where('location', 'admin')->where('extension_id', $plugin->id)->where('show_menu', 1)->get() as $com)
                    @if(Permission::hasPerm($com->alias, 'CAN_ACCESS'))
                        <li class="">
                            <a href="{{ $com->alias }}"><i class="glyphicon glyphicon-bookmark"></i> {{ \Language::getCom(strtolower($plugin->name).'.lbl_'.$com->name) }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endif
@endforeach
<?php 
    $chkCom = false;
    $components = \App\Com\System\Route::get('admin', null, 'Component');
    foreach($components as $com){
        if(Permission::hasPerm($com->alias, 'CAN_ACCESS')){
            $chkCom = true;
            break;
        }
    }
?>
@if(Permission::hasPerm('blocks', 'CAN_ACCESS') || $chkCom)
<li class="dropdown">
    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button">{{ \Language::getCom('system.lbl_component') }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li class="">
            <a href="blocks"><span class="glyphicon glyphicon-th-large"></span> {{ \Language::getCom('system.lbl_block') }}</a>
        </li>
        @if($chkCom)
        <li role="separator" class="divider"></li>
        @endif
        @foreach($components as $com)
            @if($com->show_menu && Permission::hasPerm($com->alias, 'CAN_ACCESS'))
                <li class="">
                    <a href="{{ $com->alias }}"><i class="glyphicon glyphicon-bookmark"></i> {{ \Language::getCom(''.strtolower($com->extension_name).'.lbl_'.$com->name) }}</a>
                </li>
            @endif
        @endforeach
    </ul>
</li>
@endif

@if(Permission::inHasPerm(['extensions', 'templates', 'languages'], 'CAN_ACCESS'))
<li class="dropdown">
    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button">{{ \Language::getCom('system.lbl_extension') }} <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        @if(Permission::hasPerm('extensions', 'CAN_ACCESS'))
        <li class="">
            <a href="extensions"><span class="fa fa-cubes"></span> {{ \Language::getCom('system.lbl_extension_manager') }}</a>
        </li>
        @endif
        @if(Permission::inHasPerm(['templates', 'languages'], 'CAN_ACCESS'))
        <li role="separator" class="divider"></li>
        @endif
        @if(Permission::hasPerm('templates', 'CAN_ACCESS'))
        <li class="">
            <a href="templates"><span class="glyphicon glyphicon-th-list"></span> {{ \Language::getCom('system.lbl_template') }}</a>
        </li>
        @endif 
        @if(Permission::hasPerm('languages', 'CAN_ACCESS'))
        <li class="">
            <a href="languages"><span class="fa fa-language"></span> {{ \Language::getCom('system.lbl_language') }}</a>
        </li>
        @endif
    </ul>
</li>
@endif