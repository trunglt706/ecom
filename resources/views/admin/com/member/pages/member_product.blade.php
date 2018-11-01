<!--ko foreach: memberProducts()-->
<section class="media-panel">
    <div id="header">
        <div id="title">
            <strong data-bind="html: text "></strong>
            <small class="badge" data-bind="html: products().length + ' {{ \Language::getCom("member.lbl_product") }}'"></small>
        </div>
    </div>
    <div id="body">
        <!--ko foreach: products()-->
        <!--ko if: approved_at() != ''-->
        <div id="img" data-bind="style: { backgroundImage: 'url({{ config("data.PATH_ROOT") }}' + content() + ')' }, attr: { 'title': product_name() }">
            <div id="caption">
                <div data-bind="html: product_name()"></div>
                <div id="btn-bottom">
                    <div class="btn-group" role="group">
                        <div type="button" class="btn btn-success">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ko-->
        <!--ko if: approved_at() == ''-->
        <div id="img" data-bind="style: { backgroundImage: 'url({{ config("data.PATH_ROOT") }}' + content() + ')' }, attr: { 'title': product_name() }">
            <div id="caption">
                <div data-bind="html: product_name()"></div>
                <div id="btn-bottom">
                    <div class="btn-group" role="group">
                        <div type="button" class="btn btn-default" data-bind="click: $root.checkProduct.bind($data, $rawData)">
                            <!--ko if: approved()-->
                            <i class="glyphicon glyphicon-check"></i>
                            <!--/ko-->
                            <!--ko if: !approved()-->
                            <i class="glyphicon glyphicon-unchecked"></i>
                            <!--/ko-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ko-->
        <!--/ko-->
    </div>
</section>
<!--/ko-->
