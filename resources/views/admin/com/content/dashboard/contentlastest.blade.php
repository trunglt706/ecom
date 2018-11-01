<div style="position: absolute; width: 100%; overflow: auto; height: 100%;">
    <table class="table table-responsive table-dashed">
        <thead>
            <tr class="bg-blue" style="color: rgba(255, 255, 255, 0.75);">
                <th colspan="2"><span class="glyphicon glyphicon-edit"></span> {{ Language::getCom('content.lbl_content_lastest') }}</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach(\DB::table('contents')->orderBy('created_at', 'desc')->take(5)->get() as $content)
            <tr>
                <td>{{ $content->title }}</td>
                <td class="text-muted text-right"><small>{{ date('d/m/Y', strtotime($content->created_at)) }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
