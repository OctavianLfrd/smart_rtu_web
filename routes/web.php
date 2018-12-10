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

//______MAIN_PAGE__________________________________________________________
Route::get('/', 'index@index');
//______VIEW_ADVERTISEMENTS________________________________________________
Route::get('/ads', "ads_page");
Route::get('/ads/list', "view_ads@adList");
Route::delete('/ads', "view_ads@deleteAds");
Route::patch('/ads', "view_ads@updateAds");

/*

GET /ads/lis -> view

GET /ads
GET /ads/{id}
DELETE /ads
DELETE /ads/{id}
PATH /ads/{id}    "field" => "value, "field" => "value

*/
