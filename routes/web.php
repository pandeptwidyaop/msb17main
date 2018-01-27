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
Route::get('images/{folder}/{image}',function($folder,$image){
  $url = \Storage::disk('public')->get($folder.'/'.$image);
  return $url;
});
Route::get('/', 'MainController@index');
Route::get('/downloadform','MainController@download');
Route::get('/voting','VoteController@index');
Route::get('/voting/{ticket}/check','VoteController@check');
Route::post('/voting','VoteController@show');
Route::post('/voting/vote','VoteController@vote');

Auth::routes();
