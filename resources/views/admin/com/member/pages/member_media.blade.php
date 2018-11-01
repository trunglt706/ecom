<!--ko foreach: memberMedias()-->
<!--ko if: !multiple()-->
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label" data-bind="html: text"></label>
            <!--ko foreach: medias()-->
            <a class="thumbnail" style="width:150px; height: 150px;" data-bind="click: $root.chooseImage.bind($data, 'image'+$index())">
                <div class="thumbnail-img" data-bind="style: { backgroundImage: 'url({{ config("data.PATH_ROOT") }}' + content() + ')' }, attr:{'id': 'image'+$index(), 'title': caption}"></div>
            </a>
            <!--/ko-->
        </div>
    </div>
</div>
<!--/ko-->
<!--ko if: multiple-->
<section class="media-panel">
    <div id="header">
        <div id="title">
            <strong data-bind="html: text "></strong>
            <small class="badge" data-bind="html: medias().length + ' {{ \Language::getCom("member.lbl_media") }}'"></small>
        </div>
    </div>
    <div id="body">
        <!--ko foreach: medias()-->
        <div id="img" data-bind="style: { backgroundImage: 'url(' + content() + ')' }, attr: { 'title': caption }">
            <div id="caption">
                <div id="btn-bottom">
                    <div class="btn-group" role="group">
                        <div type="button" class="btn btn-default" data-bind="click: $root.memberDelMedia.bind($data, $rawData, $parent)">
                            <i class="glyphicon glyphicon-trash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ko-->
    </div>
    <div id="footer">
        <div class="form-inline">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" readonly class="form-control" placeholder="{{ \Language::get('global.lbl_choose') }}" data-bind="attr:{'id': 'mediaContent'+$index()} ">
                    <span class="input-group-btn">
                        <div class="btn btn-default" data-bind="click: $parent.chooseMedia.bind($data, 'mediaContent'+$index())">
                            <span class="glyphicon glyphicon-folder-open"></span>
                        </div>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="{{ \Language::getCom('member.lbl_note') }}" data-bind="attr:{'id': 'mediaCaption'+$index()} ">
            </div>
            <div class="form-group">
                <input type="number" min="0" class="form-control" placeholder="{{ \Language::getCom('member.lbl_sort') }}" data-bind="attr:{'id': 'mediaSort'+$index()} ">
            </div>
            <div class="btn btn-default" data-bind="click: $parent.memberAddMedia.bind($data, $index(), $rawData) ">
                <span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }}
            </div>
        </div>
    </div>
</section>
<!--/ko-->
<!--/ko-->