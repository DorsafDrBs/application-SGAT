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

Route::get('/', 'WelcomController@index')->name('welcome');


Auth::routes();

Route::any('/home', 'HomeController@index')->name('home');
Route::get('findProjectName','HomeController@findProjectName');
Route::any('/home2', 'HomeController@index2')->name('home2');
Route::any('/test', 'testController@test')->name('test');
Route::get('cartographie','CartographieController@cartographie')->name('cartographie');
Route::group(['middleware' => ['auth']], function() {
    Route::get('manager','HomeController@manager')->name('manager');
    Route::any('profile/profile','ProfileController@index')->name('profile.index');
    Route::any('profile/profile/update','ProfileController@update')->name('profile.update');
    Route::resource('roles/roles','RoleController');
    Route::resource('users/users','UserController');
    Route::resource('process/process','ProcessController');
    Route::resource('projects/projects','ProjectsController');
    Route::resource('indicators/indicators','IndicatorsController');
    Route::resource('indicprocs/indicprocs','IndicatorsprocController');
    Route::resource('indicprojs/indicprojs','IndicatorsprojController');
    Route::resource('indicusers/indicusers','IndicatorusersController');
    Route::post('indicators/indicators/importExcel','IndicatorsController@importExcel')->name('indicators.index.importExcel');
    Route::post('indicators/indicators/importerExcelprojet','IndicatorsController@importerExcelprojet')->name('indicators.index.importerExcelprojet');
    Route::post('indicators/indicators/importerExcelcollabo','IndicatorsController@importerExcelcollabo')->name('indicators.index.importerExcelcollabo');
});