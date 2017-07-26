@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Response</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('mocks.update', ['id' => $id]) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('request_uri') ? ' has-error' : '' }}">
                                <label for="url" class="col-md-2 control-label">URL</label>

                                <div class="col-md-2">
                                    <select class="form-control" id="request_method" name="request_method">
                                        @foreach(config('app.methods') as $method)
                                            <option value ="{{ $method }}" {{ $request_method == $method ? 'selected' : '' }}>{{ $method }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input id="request_uri" type="url" class="form-control" name="request_uri" value="{{ $request_uri }}" required autofocus>

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
                                    <select class="form-control" id="response_code" name="response_code">
                                        @foreach(config('app.codes') as $code)
                                        <option value ="{{ (int) $code }}" {{ $response_code == (int) $code ? 'selected' : '' }}>{{ $code }}</option>
                                        @endforeach
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
                                    <select class="form-control" name="response_content_type">
                                        @foreach(config('app.content_types') as $content_type)
                                            <option value ="{{ $content_type }}" {{ $response_content_type == $content_type ? 'selected' : '' }}>{{ $content_type }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('response_content_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('response_content_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="response_charset">
                                        @foreach(config('app.charsets') as $charset)
                                            <option value ="{{ $charset }}" {{ $response_charset == $charset ? 'selected' : '' }}>{{ $charset }}</option>
                                        @endforeach
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
                                    <textarea id="response_body" class="form-control" name="response_body" required>{{ $response_body }}</textarea>

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