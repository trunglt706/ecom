<div class="card" id="article-{{ $article->id }}">
    <div class="card-body p-10">
        <div class="media">
            <div class="pull-left">
                <span class="media-object img-background" style="width: 100px; height: 100px; background-image: url('<?php echo $article->image ?>')"></span>
            </div>
            <div class="media-body">
                <h4 class="lv-title">{{ $article->title }}</h4>
                <section class="lv-small"><?php echo explode('<hr />', $article->content)[0]; ?></section>
            </div>
        </div>
    </div>
    <ul class="list-unstyled clearfix wpb-actions p-10">
        <li class="wpba-attrs">
            <ul class="list-unstyled list-inline m-l-0 m-t-5 text-muted">
                <li>
                    <small>
                        <i class="glyphicon glyphicon-time"></i> {{ date('H:i d-m-Y', strtotime(str_replace("/","-", $article->created_at))) }}
                    </small>
                </li>
                <li>
                    <small>
                        <i class="glyphicon glyphicon-user"></i> {{ \User::find($article->user_id)->fullname }}
                    </small>
                </li>
            </ul>
        </li>
        <li class="pull-right"><a class="btn btn-primary btn-sm btn-xs waves-effect" href="{{ $article->url }}">{{ Language::getTemplate('emaptemplate.lbl_readmore') }} <span class="glyphicon glyphicon-chevron-right"></span></a></li>
    </ul>
</div>
