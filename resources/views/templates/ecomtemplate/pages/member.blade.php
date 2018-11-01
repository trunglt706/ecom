@extends(Path::viewCurrentTemplate($data['page']->lang, 'layouts.base'))

@section('keywords')
<meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>"/>
@endsection
@section('description')
<meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>"/>
@endsection
@section('title')
<?php echo strip_tags($data['page']->menu_name); ?>
@endsection

@section('current-css')
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/members.css') }}" rel="stylesheet">
<link href="{{ Path::urlCurrentTemplate($data['page']->lang, 'css/jquery.flipster.min.css') }}" rel="stylesheet">
@endsection

@section('jsc')
<script src="{{ Path::urlCurrentTemplate($data['page']->lang, 'js/jquery.flipster.min.js') }}" type="text/javascript"></script>
@endsection

@section('main')
@include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.header'))
<section id="member" class="margin-top no-banner">
    <div class="member-gold">
        <div class="container">
            <div class="member-slogan text-uppercase effect2">
                <div class="slogan">
                    {{ \Language::getTemplate('ecomtemplate.lbl_member') }}
                    {{ \Language::getTemplate('ecomtemplate.lbl_go_together') }}
                </div>
                <div class="vpa text-uppercase">
                    {{ \Language::getTemplate('ecomtemplate.lbl_vpa') }}
                </div>
            </div>
            <div id="coverflow">
                <ul class="flip-items">
                    @foreach ($data['gold_members'] as $gold_member)
                    <li data-flip-title="{{ $gold_member->member_name }}">
                        <a href="{{ $gold_member->url }}">
                            <div class="card-gold">
                                <img style="max-width: 100px" src="{{ $gold_member->media }}">
                                <div class="company-name">{{ $gold_member->member_name }}</div>
                                <hr>
                                {{ $gold_member->member_address }}
                                <br>
                                {{ $gold_member->member_phone }}
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <script>
                $("#coverflow").flipster({spacing: -0.5, buttons: true, loop: true});
                $("#coverflow").flipster('play', 5000);
            </script>

        </div>
    </div>
    <?php echo Block::render($data['blocks'], 'customhtml', 'slideshow') ?>
    <?php echo Block::render($data['blocks'], 'member_gold', 'top-a') ?>
    <?php echo Block::render($data['blocks'], 'member_option', 'top-b') ?>
    @include(Path::viewCurrentTemplate($data['page']->lang, 'blocks.memberActivity'))
</section>
@include(Path::viewCurrentTemplate( $data['page']->lang, 'pages.footer'))
@endsection
