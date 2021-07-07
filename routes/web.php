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

Route::resource('Dashboard', DashboardController::class);

Route::resource('Countries', CountriesController::class);
Route::resource('Teams', TeamsController::class);
Route::resource('Statistics', StatisticsController::class);
Route::get('Statistics/create/{leagues_id}', 'StatisticsController@create')->name('Statistics.create');


Route::resource('Teamleagues', TeamleaguesController::class);
	Route::get('Teamleagues/create/{leagues_id}', 'TeamleaguesController@create')->name('Teamleagues.create');


Route::resource('Matches', MatchesController::class);
Route::get('Matches/create_prematch/{leagues_id}', 'MatchesController@create_prematch')->name('Matches.create_prematch');
Route::get('Matches/create_postmatch/{leagues_id}', 'MatchesController@create_postmatch')->name('Matches.create_postmatch');


Route::resource('Prematches', PrematchesController::class);
	Route::get('Prematches/create/{leagues_id}', 'PrematchesController@create')->name('Prematches.create');

Route::resource('Postmatches', PostmatchesController::class);
	Route::get('Postmatches/create/{leagues_id}', 'PostmatchesController@create')->name('Postmatches.create');

Route::resource('Brazil', BrazilController::class);
Route::resource('Unitedstates', UnitedstatesController::class);
Route::resource('Norway', NorwayController::class);
Route::resource('Sweden', SwedenController::class);
Route::resource('Finland', FinlandController::class);

