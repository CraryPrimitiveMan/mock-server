<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\MockRequest;
use Illuminate\Support\Facades\Request;

if (config('app.url') != Request::getHttpHost() && PHP_SAPI != 'cli') {
    $response = MockRequest::select(['response_code', 'response_content_type', 'response_charset', 'response_headers', 'response_body'])
        ->where('request_uri', Request::url())
        ->where('request_method', Request::method())
        ->where('enable', 'Y')
        ->first();
    
    if (!empty($response)) {
        http_response_code($response->response_code);
        header("Content-type:{$response->response_content_type};charset={$response->response_charset}");
        echo $response->response_body;
        exit();
    }
}

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('mocks', 'MockRequestController');

Route::post('mocks/{mock}/enable', 'MockRequestController@enable')->name('mocks.enable');
Route::post('mocks/{mock}/disable', 'MockRequestController@disable')->name('mocks.disable');
