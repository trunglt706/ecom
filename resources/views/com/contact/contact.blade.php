<section class="block-contact">
    <section class="preloader-container"></section>
    <form role="form" id="frm-contact" class="form-horizontal">
        <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
        <input id="block_id" name="block_id" value="{{ $block->id }}" hidden>
        <div class="form-group">
            <label class="col-md-4 control-label" for="fullname">{{ Language::getCom('contact.lbl_fullname') }}</label>  
            <div class="col-md-8">
                <input id="fullname" name="fullname" type="text" placeholder="{{ Language::getCom('contact.lbl_fullname') }}" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="address">{{ Language::getCom('contact.lbl_address') }}</label>  
            <div class="col-md-8">
                <textarea id="address" name="address" placeholder="{{ Language::getCom('contact.lbl_address') }}" required rows="3" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">{{ Language::getCom('contact.lbl_phone') }}</label>  
            <div class="col-md-8">
                <input id="phone" name="phone" type="tel" placeholder="{{ Language::getCom('contact.lbl_phone') }}" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="fax">{{ Language::getCom('contact.lbl_fax') }}</label>  
            <div class="col-md-8">
                <input id="fax" name="fax" type="tel" placeholder="{{ Language::getCom('contact.lbl_fax') }}" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">{{ Language::getCom('contact.lbl_email') }}</label>  
            <div class="col-md-8">
                <input id="enail" name="email" type="email" placeholder="{{ Language::getCom('contact.lbl_email') }}" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="message">{{ Language::getCom('contact.lbl_message') }}</label>  
            <div class="col-md-8">
                <textarea id="message" name="message" placeholder="{{ Language::getCom('contact.lbl_message') }}" required rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox col-md-8 col-md-offset-4">
                <label class="control-label">
                    <input type="checkbox" name="send_me" id="send_me"> {{ Language::getCom('contact.lbl_send_me') }}
                </label>
            </div>
        </div>
        <div class="form-group text-center">
            <button type="reset" class="btn btn-default">
                <span class="glyphicon glyphicon-refresh"></span> {{ Language::getCom('contact.lbl_cancel') }}
            </button>
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-send"></span> {{ Language::getCom('contact.lbl_send') }}
            </button>
        </div>
    </form>
</section>
<script>
    $(function(){
       $('#frm-contact').on('submit', function(){
           $('.block-contact .preloader-container').addClass('active');
           $.post('{{ Path::urlSite("site-contact/add") }}', $(this).serialize(), function(data){
               $('.block-contact').html(data);
           });
           return false;
       });
    });
</script>
