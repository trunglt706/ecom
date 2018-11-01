<!--cfmAjaxError-->
<div class="modal" id="cfmAjaxError" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="cfmAjaxError" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-delete">
            <div class="modal-body">
                <h3><?php echo \Language::get('global.message_ajax_error'); ?></h3><br>
                <button class="btn btn-default" id="btnReloadPage"><i class="glyphicon glyphicon-refresh"></i> {{ \Language::get('global.lbl_reload') }}</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ajaxError(function(){
        $('#cfmAjaxError').modal('show');
    });
    $('#btnReloadPage').on('click', function(){
        location.reload();
    });
</script>