<footer>
    <div class="container-fluid">
        Copyright © 2015 <a href="{{ env('APP_AUTHOR_URL', '#!') }}" target="_blank">{{ env('APP_AUTHOR', '') }}</a>
        <span class="pull-right">{{ \Language::get('global.lbl_version') }}: {{ \System::getValue('system', 'version') }} - {{ \Language::get('global.lbl_version_updated_at') }}: {{ \System::getValue('system', 'creation_date') }}</span>
    </div>
</footer>
