<?php
    $idx = $block->id . '_' . time();
    $attribs = json_decode($block->attribs);
    $slider = DB::table('sliders')->where('id', $attribs->slider_id)->first();
    $slides = json_decode($slider->content);
    $col = round(12/$attribs->items);
    $len = count($slides);
    $page = round($len/$attribs->items)
?>
<div class="{{ $attribs->advance_class }}">
    @if($attribs->show_title == 1)
    <div class="block-title">
        <h3>{{ $block->title }}</h3>
    </div>
    @endif
    <div class="carousel slide" data-ride="carousel" id="slider_{{ $idx }}">
        @if($attribs->show_indicator == 1)
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @for($i=0; $i<$page; $i++)
            <li class="{{ $i==0 ? 'active':'' }}" data-slide-to="{{ $i }}" data-target="#slider_{{ $idx }}">&nbsp;</li>
        	@endfor
        </ol>
        @endif

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @for($i=0; $i<$len;)
            <div class="item {{ $i==0 ? 'active':'' }}">
                <div class="row">
                    @for($n = 0; $n < $attribs->items; $n++)
                    <div class="col-xs-{{ $col }}">
                        <div class="item-container">
                            @if($slides[$i]->url != '')
                            <a href="{{ $slides[$i]->url }}">
                                <img alt="slide {{ $i }}" src="{{ config("data.PATH_ROOT").$slides[$i]->img }}" style="width: 100%;" />
                            </a>
                            @else
                            <img alt="slide {{ $i }}" src="{{ config("data.PATH_ROOT").$slides[$i]->img }}" style="width: 100%;" />
                            @endif
                            @if(strip_tags($slides[$i]->caption) != '')
                            <div class="carousel-caption">
                                {!! $slides[$i]->caption !!}
                            </div>
                            @endif
                        </div>
                    </div>
                    <?php $i++; ?>
                    @endfor
                </div>
            </div>
            @endfor
        </div>

        @if($attribs->show_control == 1)
        <!-- Controls -->
        <a class="left carousel-control" href="#slider_{{ $idx }}" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#slider_{{ $idx }}" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        @endif
    </div>
</div>
