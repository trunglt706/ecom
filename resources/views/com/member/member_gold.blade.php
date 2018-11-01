@if (count($block['members']) > 0)
<div style="background: #ffffff; margin-top: 10px; padding-bottom: 10px;">
    <div class="container">
        <div class="block-header">
            <h3 class="text-uppercase" style="color: #bd6a00;">{{ $block['block']->title }}</h3>
        </div>
        <div class="row">
            @foreach($block['members'] as $member)
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="col-sm-4">
                    <a href="{{ $member->alias }}" class="thumbnail" > <img src="{{ $member->content }}" style="width:100%;height:150px;"/></a>
                </div>
                <div class="col-sm-8">
                    <a href="{{ $member->alias }}"><h4 class="text-uppercase">{{ $member->member_name }}</h4></a>
                    @if ($member->info != '')
                    <p>{!! $member->info !!}</p>
                    @else
                    <p>{{ \Language::getcom('member.lbl_member_address') }}: {{$member->member_address}}</p>
                    <p style="margin-top:-10px;">{{ \Language::getcom('member.lbl_member_phone') }}: {{$member->member_phone}}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@else
<div></div>
@endif
