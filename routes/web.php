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
    Route::any(Request::getRequestUri(), 'MockController@all');
}

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('mocks', 'MockResponseController');

Route::post('mocks/{mock}/enable', 'MockResponseController@enable')->name('mocks.enable');
Route::post('mocks/{mock}/disable', 'MockResponseController@disable')->name('mocks.disable');
