<?php
    $members = \DB::table('members');
    if( \Permission::in_group_code(['BRANCH']) ){
        $members->where('town_id', json_decode(Auth::user()->note)->town_id);
    }
?>

<div class="widget widget-stats bg-blue-grey">
	<div class="stats-icon"><i class="fa fa-users"></i></div>
	<div class="stats-info">
		<h4>{{ Language::getCom('member.lbl_member') }}</h4>
		<p>{{ $members->count() }}</p>
	</div>
	<div class="stats-link"><a href="member">{{ Language::getCom('system.lbl_view_detail') }} <i class="fa fa-arrow-circle-o-right"></i></a></div>
</div>
