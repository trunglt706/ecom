<?php
    $members = \DB::table('members')->orderBy('created_at', 'desc')->take(5);
    if( \Permission::in_group_code(['BRANCH']) ){
        $members->where('town_id', json_decode(Auth::user()->note)->town_id);
    }
?>
<div style="position: absolute; width: 100%; overflow: auto; height: 100%;">
    <table class="table table-responsive table-dashed">
        <thead>
            <tr class="bg-blue-grey" style="color: rgba(255, 255, 255, 0.75);">
                <th colspan="2"><span class="glyphicon glyphicon-user"></span> {{ Language::getCom('member.lbl_member_lastest') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach( $members->get() as $member)
            <tr>
                <td>{{ $member->member_name }}</td>
                <td class="text-muted text-right"><small>{{ date('d/m/Y', strtotime($member->created_at)) }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
