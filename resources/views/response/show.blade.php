@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Show Response</div>
                    <div class="panel-body">
                            <div class="form-group clearfix">
                                <label for="url" class="col-md-2 control-label">URL</label>

                                <div class="col-md-1">
                                    {{ $request_method }}
                                </div>
                                <div class="col-md-9">
                                    {{ $request_uri }}
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label for="response_code" class="col-md-2 control-label">Response Code</label>

                                <div class="col-md-4">
                                    {{ $response_code }}
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label for="response_content_type" class="col-md-2 control-label">Response Content Type</label>

                                <div class="col-md-8">
                                    {{ $response_content_type }}
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label for="response_charset" class="col-md-2 control-label">Response Charset</label>

                                <div class="col-md-8">
                                    {{ $response_charset }}
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label for="url" class="col-md-2 control-label">Response Body</label>

                                <div class="col-md-8">
                                    {!! nl2br(str_replace(' ', '&nbsp;', $response_body)) !!}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection