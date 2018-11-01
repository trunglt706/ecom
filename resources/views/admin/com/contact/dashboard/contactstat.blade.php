<?php
    $contacts = \DB::table('contacts');
    if( \Permission::in_group_code(['BRANCH'])){
        $filters = \DB::table('members')->where('town_id', json_decode(\Auth::user()->note)->town_id)->pluck('id');
        $contacts->whereIn('member_id', $filters);
    }
?>

<div class="widget widget-stats bg-purple">
	<div class="stats-icon"><i class="fa fa-users"></i></div>
	<div class="stats-info">
		<h4>{{ Language::getCom('contact.lbl_contact') }}</h4>
		<p>{{ $contacts->count() }}</p>
	</div>
	<div class="stats-link"><a href="contact">{{ Language::getCom('system.lbl_view_detail') }} <i class="fa fa-arrow-circle-o-right"></i></a></div>
</div>
