<?php
use Illuminate\Http\Request;

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

Auth::routes();
Route::group(['middleware'=>'auth'], function(){
    //Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'TaskController@index');
    Route::get('/tasks/{task_id?}', 'TaskController@edit');
    Route::post('/tasks', 'TaskController@store');
    Route::put('/tasks/{task_id?}', 'TaskController@update' );    
    Route::delete('/tasks/{task_id?}', 'TaskController@destroy' );    
});

