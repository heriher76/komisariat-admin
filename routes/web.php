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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () use ($router) {
  Route::get('/admin', 'HomeController@index')->name('home');
  Route::resource('/admin/calendar', 'CalendarController');
  Route::resource('/admin/structure', 'StructureOrganizationController');
  Route::resource('/admin/article', 'ArticleController');
  Route::resource('/admin/ebook', 'EbookController');
  Route::resource('/admin/info-training', 'TrainingController');
  Route::resource('/admin/database-kader', 'DatabaseKaderController');
  Route::resource('/admin/yt-channels', 'YtChannelController');
  Route::get('/admin/profile', 'ProfileController@index');
  Route::put('/admin/profile', 'ProfileController@update');
});
