<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fullname" class="control-label">{{ \Language::getCom('content.lbl_fullname') }} *</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" data-bind="value: current().fullname" required placeholder="{{ \Language::getCom('content.lbl_fullname') }}">
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">{{ \Language::getCom('content.lbl_address') }} *</label>
                    <input type="text" class="form-control" name="address" id="address" data-bind="value: current().address" required placeholder="{{ \Language::getCom('content.lbl_address') }}">
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">{{ \Language::getCom('content.lbl_phone') }} *</label>
                    <input type="text" class="form-control" name="phone" id="phone" data-bind="value: current().phone" required placeholder="{{ \Language::getCom('content.lbl_phone') }}">
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">{{ \Language::getCom('content.lbl_email') }} *</label>
                    <input type="text" class="form-control" name="email" id="email" data-bind="value: current().email" required placeholder="{{ \Language::getCom('content.lbl_email') }}">
                </div>
                <div class="form-group">
                    <label for="message" class="control-label">{{ \Language::getCom('content.lbl_message') }} *</label>
                    <textarea rows="5" class="form-control" name="message" id="message" data-bind="value: current().message" required placeholder="{{ \Language::getCom('content.lbl_message') }}"></textarea>
                </div>
            </div>
            <div class="col-md-6 text-center">

            </div>
        </div>
    </div>
</div>
