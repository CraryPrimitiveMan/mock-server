<?php

namespace App\Http\Controllers;

use App\MockRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mockRequqets = MockRequest::all()->all();
        return view('request.index', ['data' => $mockRequqets]);
    }
    
    public function create()
    {
        return view('request.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->all();
        $mockRequest = new MockRequest();
        $mockRequest->user_id = 1;
        $mockRequest->domain = 'www.qq.com';
        $mockRequest->request_method = 'GET';
        $mockRequest->request_uri = 'http://www.qq.com/test/';
        $mockRequest->response_code = 200;
        $mockRequest->response_content_type = 'application/json';
        $mockRequest->response_charset = 'UTF-8';
        $mockRequest->response_headers = 'Etag:1';
        $mockRequest->response_body = '{"a":"b"}';
        $mockRequest->save();
    }
}
