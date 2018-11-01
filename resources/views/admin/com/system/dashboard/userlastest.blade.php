<div style="position: absolute; width: 100%; overflow: auto; height: 100%;">
    <table class="table table-responsive table-dashed">
        <thead>
            <tr class="bg-teal" style="color: rgba(255, 255, 255, 0.75);">
                <th colspan="2"><span class="glyphicon glyphicon-user"></span> {{ Language::getCom('system.lbl_user_lastest') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach(\DB::table('users')->orderBy('created_at', 'desc')->take(5)->get() as $user)
            <tr>
                <td>{{ $user->fullname }}</td>
                <td class="text-muted text-right"><small>{{ date('d/m/Y', strtotime($user->created_at)) }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
