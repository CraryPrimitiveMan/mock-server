@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Response List</h4>
                    <a class="pull-right btn btn-primary" href="{{ route('mocks.create') }}">
                        Create Response
                    </a>
                </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Method</th>
                            <th>URL</th>
                            <th>Response Body</th>
                            <th class="operation">Operation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item['request_method'] }}</td>
                            <td>{{ $item['request_uri'] }}</td>
                            <td title="{{ $item['response_body'] }}">{{ str_limit($item['response_body'], 50, '...') }}</td>
                            <td>
                                <a class="btn btn-default glyphicon glyphicon-eye-open" title="View" href="{{ route('mocks.show', ['id' => $item['id']]) }}"></a>
                                <a class="btn btn-primary glyphicon glyphicon-edit" title="Edit" href="{{ route('mocks.edit', ['id' => $item['id']]) }}"></a>
                                @if($item['enable'] == 'N')
                                    <form style="display: inline-block;" action="{{ route('mocks.enable', ['id' => $item['id']]) }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-info glyphicon glyphicon-ok-circle" title="Enable"></button>
                                    </form>
                                @else
                                    <form style="display: inline-block;" action="{{ route('mocks.disable', ['id' => $item['id']]) }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-warning glyphicon glyphicon-ban-circle" title="Disable"></button>
                                    </form>
                                @endif
                                <form style="display: inline-block;" action="{{ route('mocks.destroy', ['id' => $item['id']]) }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-danger glyphicon glyphicon-trash" title="Delete"></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
