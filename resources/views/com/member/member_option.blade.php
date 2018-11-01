@if (count($block['members']) > 0)
<div style="{{ $block['bg_color'] }}">
    <div class="container">
        <h3 class="text-uppercase" style="{{ $block['color'] }}">{{ $block['block']->title }} <small class="text-lowercase">{{ $block['count'] . ' ' . \Language::getTemplate('ecomtemplate.lbl_member') }}</small></h3>
        <ul class="filters hidden-xs">
            <li>
                <a href="{{ $block['menu_members'] }}">{{ \Language::getTemplate('ecomtemplate.lbl_view_all') }} <span class="glyphicon glyphicon-chevron-right"></span></a>
            </li>
        </ul>
        <div id="member-slideshow" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach ($block['members'] as $key=>$members)
                <div class="item {{ $key == 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach ($members as $member)
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a href="{{ $member->alias }}">
                                <div class="member-cover">
                                    <div class="member-image" style="background-image: url('{{ $member->content }}')"></div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#member-slideshow" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#member-slideshow" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@else
<div></div>
@endif
