@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Response</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('mocks.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('request_uri') ? ' has-error' : '' }}">
                                <label for="url" class="col-md-2 control-label">URL</label>

                                <div class="col-md-2">
                                    <select class="form-control" id="request_method" name="request_method" value="{{ old('request_method') }}" >
                                        <option value ="GET" selected>GET</option>
                                        <option value ="POST">POST</option>
                                        <option value="PUT">PUT</option>
                                        <option value="PATCH">PATCH</option>
                                        <option value="DELETE">DELETE</option>
                                        <option value="OPTIONS">OPTIONS</option>
                                        <option value="ANY">ANY</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input id="request_uri" type="url" class="form-control" name="request_uri" value="{{ old('request_uri') }}" required autofocus>

                                    @if ($errors->has('request_uri'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('request_uri') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('response_code') ? ' has-error' : '' }}">
                                <label for="response_code" class="col-md-2 control-label">Response Code</label>

                                <div class="col-md-4">
                                    <select class="form-control" id="response_code" name="response_code" value="{{ old('response_code') }}">
                                        <option value ="100">100 Continue</option>
                                        <option value ="101">101 Switching Protocols</option>
                                        <option value ="102">102 Processing</option>
                                        <option value ="200" selected>200 OK</option>
                                        <option value ="201">201 Created</option>
                                        <option value ="202">202 Accepted</option>
                                        <option value ="203">203 Non-Authoritative Information</option>
                                        <option value ="204">204 No Content</option>
                                        <option value ="205">205 Reset Content</option>
                                        <option value ="206">206 Partial Content</option>
                                        <option value ="207">207 Multi-Status</option>
                                        <option value ="208">208 Already Reported</option>
                                        <option value ="226">226 IM Used</option>
                                        <option value ="300">300 Multiple Choices</option>
                                        <option value ="301">301 Moved Permanently</option>
                                        <option value ="302">302 Found</option>
                                        <option value ="303">303 See Other</option>
                                        <option value ="304">304 Not Modified</option>
                                        <option value ="305">305 Use Proxy</option>
                                        <option value ="306">306 Switch Proxy</option>
                                        <option value ="307">307 Temporary Redirect</option>
                                        <option value ="308">308 Permanent Redirect</option>
                                        <option value ="400">400 Bad Request</option>
                                        <option value ="401">401 Unauthorized</option>
                                        <option value ="402">402 Payment Required</option>
                                        <option value ="403">403 Forbidden</option>
                                        <option value ="404">404 Not Found</option>
                                        <option value ="405">405 Method Not Allowed</option>
                                        <option value ="406">406 Not Acceptable</option>
                                        <option value ="407">407 Proxy Authentication Required</option>
                                        <option value ="408">408 Request Timeout</option>
                                        <option value ="409">409 Conflict</option>
                                        <option value ="410">410 Gone</option>
                                        <option value ="411">411 Length Required</option>
                                        <option value ="412">412 Precondition Failed</option>
                                        <option value ="413">413 Request Entity Too Large</option>
                                        <option value ="414">414 Request-URI Too Long</option>
                                        <option value ="415">415 Unsupported Media Type</option>
                                        <option value ="416">416 Requested Range Not Satisfiable</option>
                                        <option value ="417">417 Expectation Failed</option>
                                        <option value ="418">418 I'm a teapot</option>
                                        <option value ="420">420 Enhance Your Calm</option>
                                        <option value ="422">422 Unprocessable Entity</option>
                                        <option value ="423">423 Locked</option>
                                        <option value ="424">424 Failed Dependency</option>
                                        <option value ="425">425 Unordered Collection</option>
                                        <option value ="426">426 Upgrade Required</option>
                                        <option value ="428">428 Precondition Required</option>
                                        <option value ="429">429 Too Many Requests</option>
                                        <option value ="431">431 Request Header Fields Too Large</option>
                                        <option value ="444">444 No Response</option>
                                        <option value ="449">449 Retry With</option>
                                        <option value ="450">450 Blocked by Windows Parental Controls</option>
                                        <option value ="499">499 Client Closed Request</option>
                                        <option value ="500">500 Internal Server Error</option>
                                        <option value ="501">501 Not Implemented</option>
                                        <option value ="502">502 Bad Gateway</option>
                                        <option value ="503">503 Service Unavailable</option>
                                        <option value ="504">504 Gateway Timeout</option>
                                        <option value ="505">505 HTTP Version Not Supported</option>
                                        <option value ="506">506 Variant Also Negotiates</option>
                                        <option value ="507">507 Insufficient Storage</option>
                                        <option value ="509">509 Bandwidth Limit Exceeded</option>
                                        <option value ="510">510 Not Extended</option>
                                    </select>
                                    @if ($errors->has('response_code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('response_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('response_content_type') ? ' has-error' : '' }}">
                                <label for="response_code" class="col-md-2 control-label">Response Content Type</label>

                                <div class="col-md-4">
                                    <select class="form-control" name="response_content_type" value="{{ old('response_content_type') }}">
                                        <option value ="application/json" selected>application/json</option>
                                        <option value ="application/x-www-form-urlencoded">application/x-www-form-urlencoded</option>
                                        <option value ="application/xhtml+xml">application/xhtml+xml</option>
                                        <option value ="application/xml">application/xml</option>
                                        <option value ="multipart/form-data">multipart/form-data</option>
                                        <option value ="text/css">text/css</option>
                                        <option value ="text/csv">text/csv</option>
                                        <option value ="text/html">text/html</option>
                                        <option value ="text/json">text/json</option>
                                        <option value ="text/plain">text/plain</option>
                                        <option value ="text/xml">text/xml</option>
                                    </select>
                                    @if ($errors->has('response_content_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('response_content_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="response_charset" value="{{ old('response_charset') }}">
                                        <option value ="UTF-8" selected>UTF-8</option>
                                        <option value ="ISO-8859-1">ISO-8859-1</option>
                                        <option value ="UTF-16">UTF-16</option>
                                    </select>
                                    @if ($errors->has('response_charset'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('response_charset') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('response_body') ? ' has-error' : '' }}">
                                <label for="url" class="col-md-2 control-label">Response Body</label>

                                <div class="col-md-8">
                                    <textarea id="response_body" class="form-control" name="response_body" required>{{ old('response_body') }}</textarea>

                                    @if ($errors->has('response_body'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('response_body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection