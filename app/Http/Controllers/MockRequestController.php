<?php

namespace App\Http\Controllers;

use App\MockRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mockRequqets = MockRequest::all()->all();
        return view('request.index', ['data' => $mockRequqets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('request_method', 'request_uri', 'response_code', 'response_content_type', 'response_charset', 'response_body');
        $parsedUrl = parse_url($data['request_uri']);
        $data['user_id'] = Auth::id();
        $data['scheme'] = $parsedUrl['scheme'];
        $data['domain'] = $parsedUrl['host'];
        $data['path'] = $parsedUrl['path'];
        $data['response_headers'] = '';
        $mockRequest = new MockRequest();
        $mockRequest->fill($data);
        $mockRequest->save();
        return redirect()->route('mocks.index')->with('message', 'Create successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mockRequest = MockRequest::find($id);
        return view('request.show', $mockRequest->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mockRequest = MockRequest::find($id);
        return view('request.edit', $mockRequest->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only('request_method', 'request_uri', 'response_code', 'response_content_type', 'response_charset', 'response_body');
        $parsedUrl = parse_url($data['request_uri']);
        $data['scheme'] = $parsedUrl['scheme'];
        $data['domain'] = $parsedUrl['host'];
        $data['path'] = $parsedUrl['path'];
        $data['response_headers'] = '';
        $mockRequest = MockRequest::find($id);
        $mockRequest->fill($data);
        $mockRequest->save();
        return redirect()->route('mocks.index')->with('message', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mockRequest = MockRequest::find($id);
        $mockRequest->delete();
        return redirect()->route('mocks.index')->with('message', 'Delete successfully!');
    }
    
    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable($id)
    {
        $mockRequest = MockRequest::find($id);
        $mockRequest->enable = 'Y';
        $mockRequest->save();
        return redirect()->route('mocks.index')->with('message', 'Enable successfully!');
    }
    
    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable($id)
    {
        $mockRequest = MockRequest::find($id);
        $mockRequest->enable = 'N';
        $mockRequest->save();
        return redirect()->route('mocks.index')->with('message', 'Enable successfully!');
    }
}
