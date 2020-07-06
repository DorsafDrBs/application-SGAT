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
Route::get('/json-home-taches','HomeController@taches');
Route::get('/json-home-programs','HomeController@programs');
Route::get('/json-home-perimetres','HomeController@perimetres');

Route::get('findProjectName','HomeController@findProjectName');
Route::any('/home2', 'HomeController@index2')->name('home2');
Route::resource('/test', 'testController');
Route::get('cartographie','CartographieController@cartographie')->name('cartographie');
Route::group(['middleware' => ['auth']], function() {

    Route::get('parameters','HomeController@parameters')->name('parameters');
    Route::get('manager','HomeController@manager')->name('manager');

    Route::any('profile/profile','ProfileController@index')->name('profile.index');
    Route::any('profile/profile/update','ProfileController@update')->name('profile.update');

    Route::resource('roles/roles','RoleController');

    Route::resource('users/users','UserController');
    Route::get('/json-user-taches','UserController@taches');
    Route::get('/json-user-programs','UserController@programs');
    Route::get('/json-user-perimetres','UserController@perimetres');
    Route::post('users/users/store_projet','UserController@store_Projet')->name('users.store_projet');

    Route::resource('process/process','ProcessController');
    Route::resource('perimetres/perimetres','PerimetreController');
    Route::resource('taches/taches','TachesController');
    Route::resource('programs/programs','ProgramsController');
    Route::resource('projects/projects','ProjectsController');
    Route::get('/json-taches','ProjectsController@taches');
    Route::get('/json-programs','ProjectsController@programs');
    Route::get('/json-perimetres','ProjectsController@perimetres');

    Route::post('projects/projects/store_taches','ProjectsController@store_taches')->name('projects.store_taches');
    Route::post('projects/projects/destroy_indic/{id}','ProjectsController@destroy_indic')->name('projects.destroy_indic');
    Route::post('projects/projects/update_indic','ProjectsController@update_indic')->name('projects.update_indic');

    Route::get('tachesindicators/indexindic/{id}','indicatorfortachesController@indexindic')->name('tachesindicators.indexindic');
    Route::post('tachesindicators/indexindic/storeindics','indicatorfortachesController@storeindics')->name('tachesindicators.storeindics');
    Route::patch('tachesindicators/indexindic/update/{test}','indicatorfortachesController@update')->name('tachesindicators.update');
    Route::delete('tachesindicators/indexindic/destroy/{test}','indicatorfortachesController@destroy')->name('tachesindicators.destroy');
    
    Route::resource('indicators/indicators','IndicatorsController');

    Route::resource('indicprocs/indicprocs','IndicatorsprocController');

    Route::resource('indicprojs/indicprojs','IndicatorsprojController');

    Route::resource('indicusers/indicusers','IndicatorusersController');

    Route::post('indicators/indicators/importExcel','IndicatorsController@importExcel')->name('indicators.index.importExcel');
    Route::post('indicators/indicators/importerExcelprojet','IndicatorsController@importerExcelprojet')->name('indicators.index.importerExcelprojet');
    Route::post('indicators/indicators/importerExcelcollabo','IndicatorsController@importerExcelcollabo')->name('indicators.index.importerExcelcollabo');
});