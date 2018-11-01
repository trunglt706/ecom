@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.member'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo $data['member']->member_name; ?>
@endsection

@section('section')
    <section class="ec" id="member_ads">
        <div class="container" style="margin-bottom: 50px; margin-top: 20px;">
            <ol class="breadcrumb">
                <li><a href="{{ $data['menus']->index }}">{{ $data['menus']->index_name }}</a></li>
                <li><a href="{{ $data['menus']->member }}">{{ $data['menus']->member_name }}</a></li>
                <li><a href="{{ $data['member']->url }}">{{ $data['member']->member_name }}</a></li>
                <li><a href="dashboard">Dashboard</a></li>
                <li class="active">Manager</li>
            </ol>
            <div class="col-sm-12 text-center m-t-30 p-t-30" style="height: 500px; font-size: 20em;"><i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i></div>
        </div>
    </section>
@endsection
