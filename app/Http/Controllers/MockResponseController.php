<?php

namespace App\Http\Controllers;

use App\MockResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockResponseController extends Controller
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
        $mockRequqets = MockResponse::orderBy('created_at', 'desc')
            ->get();
        return view('response.index', ['data' => $mockRequqets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('response.create');
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
        $isDomainRegistered = MockResponse::where('domain', $data['domain'])
            ->where('user_id', '!=', $data['user_id'])
            ->exists();
        if ($isDomainRegistered) {
            $request->flash();
            return redirect()->route('mocks.create')->with('error', 'Domain has been registered!');
        }
        $mockRequest = new MockResponse();
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
        $mockRequest = MockResponse::find($id);
        return view('response.show', $mockRequest->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mockRequest = MockResponse::find($id);
        return view('response.edit', $mockRequest->toArray());
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
        $isDomainRegistered = MockResponse::where('domain', $data['domain'])
            ->where('user_id', '!=', Auth::id())
            ->exists();
        if ($isDomainRegistered) {
            $request->flash();
            return redirect()->route('mocks.edit')->with('error', 'Domain has been registered!');
        }
        $mockRequest = MockResponse::find($id);
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
        $mockRequest = MockResponse::find($id);
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
        $mockRequest = MockResponse::find($id);
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
        $mockRequest = MockResponse::find($id);
        $mockRequest->enable = 'N';
        $mockRequest->save();
        return redirect()->route('mocks.index')->with('message', 'Enable successfully!');
    }
}
