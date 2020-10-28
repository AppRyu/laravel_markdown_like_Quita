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

Route::get('/', 'Auth\PostController@showTopPage')->name('top');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/calendar', 'HomeController@google_calendar')->name('calendar');
Route::get('calendar/start_at', 'HomeController@google_calendar_start_at');

Route::get('/drafts/new', 'Auth\PostController@index')->name('drafts.new'); 
Route::post('/drafts/new', 'Auth\PostController@postArticle')->name('drafts.new.posts'); 

Route::get('/drafts/{id}', 'Auth\PostController@showArticle')->name('item');