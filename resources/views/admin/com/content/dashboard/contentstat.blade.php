<div class="widget widget-stats bg-blue">
	<div class="stats-icon"><i class="fa fa-newspaper-o"></i></div>
	<div class="stats-info">
		<h4>{{ Language::getCom('content.lbl_content') }}</h4>
		<p>{{ \DB::table('contents')->count() }}</p>
	</div>
	<div class="stats-link"><a href="content">{{ Language::getCom('system.lbl_view_detail') }} <i class="fa fa-arrow-circle-o-right"></i></a></div>
</div>
