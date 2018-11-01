<?php
    $contacts = \DB::table('contacts')->orderBy('created_at', 'desc');
    if( \Permission::in_group_code(['BRANCH'])){
        $filters = \DB::table('members')->where('town_id', json_decode(\Auth::user()->note)->town_id)->pluck('id');
        $contacts->whereIn('member_id', $filters);
    }
?>
<div style="position: absolute; width: 100%; overflow: auto; height: 100%;">
    <table class="table table-responsive table-dashed">
        <thead>
            <tr class="bg-purple" style="color: rgba(255, 255, 255, 0.75);">
                <th colspan="2"><span class="glyphicon glyphicon-user"></span> {{ Language::getCom('contact.lbl_contact_lastest') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach( $contacts->get() as $contact)
            <tr>
                <td>{{ $contact->fullname }}</td>
                <td class="text-muted text-right"><small>{{ date('d/m/Y', strtotime($contact->created_at)) }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
