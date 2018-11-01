<div style="{{ json(background: #eceadf;}} margin-top: 10px; padding-bottom: 10px;">
    <div class="container">
        <div class="block-header">
            <?php
                $cat_id = \DB::table('member_media_categories')->where('category_name', 'Logo')->first()->id;
                $menu_member = \DB::table('menus')->where('content', 'member')->where('public', 1)->first();
                $members = \DB::table('members')->where('member_block', 0)->orderByRaw("RAND()")->take(12)->get();
                $x = 0;
            ?>
            <h3 class="text-uppercase" style="color: #bd6a00;">{{ \Language::getTemplate('ecomtemplate.lbl_member') }} <small class="text-lowercase">{{ count($members) . ' ' . \Language::getTemplate('ecomtemplate.lbl_member') }}</small></h3>
            <ul class="actions hidden-xs">
                <li>
                    <div class="btn btn-link btn-link-flag btn-default waves-effect"><a href="{{ isset($menu_member->alias) ? \Path::url($lang.'/'.$menu_member->alias) : '' }}">{{ \Language::getTemplate('ecomtemplate.lbl_view_all') }} <span class="glyphicon glyphicon-chevron-right"></span></a></div>
                </li>
            </ul>
        </div>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="row">
                        @for ($i = 0; $i < 6; $i++, $x++)
                        <?php
                            $content = \DB::table('member_medias')->where('media_category_id', $cat_id)->where('member_id', $members[$x]->id)->first();
                        ?>
                        <div class="col-sm-2 col-xs-6"><a class="thumbnail text-middle" style="height: 150px;" href="{{ \Path::url($lang . '/' . (isset($menu_member->alias) ? $menu_member->alias : \Language::getTemplate('ecomtemplate.lbl_member_alias')) . (isset($members[$x]->member_alias) ? '/' . $members[$x]->member_alias : '')) }}"> <img style="max-height: 140px;" src="{{ isset($content->content) ? $content->content : '' }}" /> </a></div>
                        @endfor
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        @for ($i = 0; $i < 6; $i++, $x++)
                        <?php
                            $content = \DB::table('member_medias')->where('media_category_id', $cat_id)->where('member_id', $members[$x]->id)->first();
                        ?>
                        <div class="col-sm-2 col-xs-6"><a class="thumbnail text-middle" style="height: 150px;" href="{{ \Path::url($lang . '/' . (isset($menu_member->alias) ? $menu_member->alias : \Language::getTemplate('ecomtemplate.lbl_member_alias')) . (isset($members[$x]->member_alias) ? '/' . $members[$x]->member_alias : '')) }}"> <img style="max-height: 140px;" src="{{ isset($content->content) ? $content->content : '' }}" /> </a></div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="zmdi zmdi-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="zmdi zmdi-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
