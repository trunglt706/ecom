<div class="widget widget-stats bg-teal">
	<div class="stats-icon"><i class="fa fa-users"></i></div>
	<div class="stats-info">
		<h4>{{ Language::getCom('system.lbl_user_manager') }}</h4>
		<p>{{ \DB::table('users')->count() }}</p>
	</div>
	<div class="stats-link"><a href="users">{{ Language::getCom('system.lbl_view_detail') }} <i class="fa fa-arrow-circle-o-right"></i></a></div>
</div>
