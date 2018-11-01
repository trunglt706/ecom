<?php
    $attribs = json_decode(Auth::user()->attribs);
    if($attribs == '') $attribs = [];
?>
<script src="{{ Path::url('js/jquery.gridster.min.js') }}"></script>
<script src="{{ Path::url('js/jquery.canvasjs.min.js') }}"></script>
<link href="{{ Path::url('css/jquery.gridster.min.css') }}" rel="stylesheet">
<link href="{{ Path::url('css/dashboard.css') }}" rel="stylesheet">
<section class="dash-wrap">
    <!-- toolbar-->
    <nav class="navbar app-comm">
        <div class="container-fluid">
            <div class="navbar-form pull-right navbar-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-plus"></span> {{ \Language::get('global.lbl_add') }} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="overflow: auto; max-height: 200px;">
                        @if(Permission::hasPerm('users', 'CAN_ACCESS'))
                            <li><b>{{ Language::getCom('system.lbl_user_manager') }}</b></li>
                            <li><a data-bind="click: add_block.bind($data, 'users', 'system.dashboard.userstat', 1,1)">{{ Language::getCom('system.lbl_quick_stat') }}</a></li>
                            <li><a data-bind="click: add_block.bind($data, 'users', 'system.dashboard.userlastest',2,2)">{{ Language::getCom('system.lbl_user_lastest') }}</a></li>
                        @endif
                        @if(Permission::hasPerm('member', 'CAN_ACCESS'))
                            <li><b>{{ Language::getCom('member.lbl_member') }}</b></li>
                            <li><a data-bind="click: add_block.bind($data, 'member', 'member.dashboard.memberstat', 1,1)">{{ Language::getCom('system.lbl_quick_stat') }}</a></li>
                            <li><a data-bind="click: add_block.bind($data, 'member', 'member.dashboard.memberlastest',2,2)">{{ Language::getCom('member.lbl_member_lastest') }}</a></li>
                        @endif
                        @if(Permission::hasPerm('contact', 'CAN_ACCESS'))
                            <li><b>{{ Language::getCom('contact.lbl_contact') }}</b></li>
                            <li><a data-bind="click: add_block.bind($data, 'contact', 'contact.dashboard.contactstat', 1,1)">{{ Language::getCom('system.lbl_quick_stat') }}</a></li>
                            <li><a data-bind="click: add_block.bind($data, 'contact', 'contact.dashboard.contactlastest',2,2)">{{ Language::getCom('contact.lbl_contact_lastest') }}</a></li>
                        @endif
                        @if(Permission::hasPerm('contents', 'CAN_ACCESS'))
                            <li><b>{{ Language::getCom('content.lbl_content') }}</b></li>
                            <li><a data-bind="click: add_block.bind($data, 'contents', 'content.dashboard.contentstat', 1,1)">{{ Language::getCom('system.lbl_quick_stat') }}</a></li>
                            <li><a data-bind="click: add_block.bind($data, 'contents', 'content.dashboard.contentlastest',2,2)">{{ Language::getCom('content.lbl_content_lastest') }}</a></li>
                        @endif
                    </ul>
                </div>
                <button type="button" class="btn btn-primary" data-bind="click: doSave"><span class="glyphicon glyphicon-floppy-disk"></span> {{ Language::get('global.lbl_save') }}</button>
                <div class="btn btn-success" data-toggle="popover" data-placement="bottom" data-content="<?php echo \Language::getCom('system.help_dashboard') ?>">
                    <i class="glyphicon glyphicon-question-sign"></i>
                </div>
            </div>
        </div>
    </nav><!-- /toolbar-->

    <div class="gridster">
        <ul>
            @foreach($attribs as $block)
                @if(Permission::hasPerm($block->rule, 'CAN_ACCESS'))
                <li class="grid-block" data-rule="{{ $block->rule }}" data-content="{{ $block->content }}" data-col="{{ $block->col }}" data-row="{{ $block->row }}" data-sizex="{{ $block->size_x }}" data-sizey="{{ $block->size_y }}">
                    <div class="close"><span aria-hidden="true">×</span></div>
                    @include(Path::viewAdminCom($block->content))
                </li>
                @endif
            @endforeach
        </ul>
    </div>

    <script>
        $(function(){ //DOM Ready
            var gridster = $(".gridster ul").gridster({
                widget_margins: [10, 10],
                widget_base_dimensions: [200, 140],
                resize: {
                    enabled: true
                }
            }).data('gridster');

            function ViewModel() {
                var self = this;

                self.add_block = function(rule, block, size_x, size_y){
                    $.ajax({url: '{{ $uri }}/block', type: 'post', data: {
                            _token: '{{ csrf_token() }}',
                            block: block
                        },
                        beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                        success: function (data) {
                            gridster.add_widget('<li class="grid-block" data-rule="'+rule+'" data-content="'+ block +'" ><div class="close"><span aria-hidden="true">&times;</span></div>'+data+ '</li>', size_x, size_y);
                        }
                    });
                };

                self.serialize = function(){
                    var serialize = [];
                    $('.gridster ul li').each(function(idx, val){
                        serialize.push({
                            size_x: $(this).attr('data-sizex'),
                            size_y: $(this).attr('data-sizey'),
                            col: $(this).attr('data-col'),
                            row: $(this).attr('data-row'),
                            content: $(this).attr('data-content'),
                            rule: $(this).attr('data-rule')
                        });
                    });
                    return serialize;
                };

                self.doSave = function(){
                    $.ajax({url: '{{ $uri }}/update', type: 'post', data: {
                            _token: '{{ csrf_token() }}',
                            attribs: JSON.stringify(self.serialize())
                        },
                        beforeSend: showAppLoader, error: errorConnect, complete: hideAppLoader,
                        success: function (data) {
                            toastr[data.status](data.message);
                            if (data.status === 'success'){
                                window.location.reload();
                            }
                        }
                    });
                };

                $(document).on('click', '.grid-block .close', function(e) {
                    gridster.remove_widget( $(this).parent() );
                });
            }
            var viewModel = new ViewModel();
            ko.applyBindings(viewModel);
        });
    </script>
</section>
