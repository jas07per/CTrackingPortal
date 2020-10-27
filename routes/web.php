<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/download_excel_template', 'HomeController@download_excel_template')->name('download_excel_template');
Route::group(['middleware'=>['auth']],function(){
        Route::get('/user','UserController@index');
        Route::group(['middleware'=>['admin']],function(){
            Route::get('/admin','AdminController@index');  
            Route::get('/user-management','AdminController@userManagement')->name('userManagement');  
            
            Route::get('/admin/remove-admin/{userId}','AdminController@removeAdmin'); 
            Route::get('/admin/add-admin/{userId}','AdminController@addAdmin');  

            Route::get('/admin/remove-finance/{userId}','AdminController@removeFinance'); 
            Route::get('/admin/add-finance/{userId}','AdminController@addFinance');  

            Route::get('/admin/add-user/{userId}','AdminController@addUser');
            Route::get('/admin/remove-user/{userId}','AdminController@removeUser');
        });

        Route::group(['middleware'=>['finance']],function(){
            Route::get('/dv/attach','DvController@index');  
            Route::get('/dv','DvController@voucher_list')->name('dv'); 
            Route::get('/dv/lacking-documents/{dvId}','DocController@addLackingDocs');
            Route::post('/add-doc','DocController@addingLackingDocs');
            Route::post('/dvadd','DvController@addDv');  
            Route::post('/attach','DvController@attach');
            Route::post('/attach-single','DvController@attachSingle');
            Route::get('/docs','DocController@index')->name('docs');
            Route::post('/docs','DocController@store');
            Route::get('/docs/{docId}','DocController@delete');
        });
      
});


Route::post('/upload_dv', 'DvController@upload_dv')->name('upload_dv');