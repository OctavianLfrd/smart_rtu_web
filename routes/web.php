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

//______REDIRECTIONS_______________________________________________________
Route::redirect('/ads', '/ads/list/1');
Route::redirect('/ads/list', '/ads/list/1');
//______MAIN_PAGE__________________________________________________________
Route::get('/', 'index@index');
//______VIEW_ADVERTISEMENTS________________________________________________
Route::get('/ads/list/{page}', "view@adlist");
Route::get('/ads/list/{page}/show', "view@listAdsByPage");
Route::delete('/ads/delete', "view@deleteAds");
