<?php

namespace App\Http\Controllers;

use App\MockResponse;
use Request;

class MockController extends Controller
{
    /**
     * Handle all other request
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $response = MockResponse::select(['response_code', 'response_content_type', 'response_charset', 'response_headers', 'response_body'])
            ->where('request_uri', Request::url())
            ->where('request_method', Request::method())
            ->where('enable', 'Y')
            ->orderBy('updated_at', 'desc')
            ->first();
    
        if (!empty($response)) {
            return response($response->response_body, $response->response_code)
                ->header('Content-type', $response->response_content_type)
                ->header('charset', $response->response_charset);
        }
    }
}