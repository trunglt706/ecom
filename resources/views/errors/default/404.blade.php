@extends('errors.default.base')

@section('main')
<div class="row">
    <div class="col-md-4 col-sm-8 col-md-offset-4 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-title">
                    <img src="{{ Path::url('images/logo.png') }}" alt="logo" />
                </div>
                <div class="panel-body">
                    <section class="row">
                        <div class="col-sm-4 text-center">
                            <img src="{{ Path::url('images/Warning-icon.png') }}" alt="Warning-icon" id="warning-icon"/>
                        </div>
                        <div class="col-sm-8">
                            <h2>404</h2>
                            <p>{{ Language::get('global.message_system_404') }}</p>
                            <br>
                            <a href="{{ Path::url("/") }}" class="btn btn-default">
                                <i class="glyphicon glyphicon-chevron-left"></i> {{ Language::get('global.lbl_back') }}
                            </a>
                        </div>
                    </section>
                </div>
            </div>
    </div>
</div>
@endsection
