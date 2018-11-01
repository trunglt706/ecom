<!--cfmDel-->
<div class="modal" id="cfmDel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmDel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-delete">
            <div class="modal-body">
                <h3>{{ \Language::get('global.lbl_delete_question') }}</h3><br>
                <button class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> {{ \Language::get('global.lbl_cancel') }}</button>
                <button class="btn btn-danger" data-dismiss="modal" data-bind="click: doDel"><i class="glyphicon glyphicon-trash"></i> {{ \Language::get('global.lbl_delete') }}</button>
            </div>
        </div>
    </div>
</div>