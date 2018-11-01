<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <img src="{{ url('dist/com/com_languages/images/'.App::getLocale().'.gif') }}" alt="languages" />
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        @foreach(System::lang('administrator/data.config.languages') as $key=>$val)
        <li class="{{ App::getLocale() == $key ? 'active':'' }}"  onclick="changeLang('{{ $key }}')">
            <a>
                <img src="{{ url('dist/com/com_languages/images/'.$key.'.gif') }}" alt="languages" /> {{ $val }}
            </a>
        </li>
        @endforeach
    </ul>
</li>
<script>
    function changeLang(lang){
        $.post('{{ url("administrator/lang/change") }}', {lang: lang}, function(data){
            if(data.status == 'success') window.location.reload();
        });
    }
</script>
