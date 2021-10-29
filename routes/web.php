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
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::resource('Countries', CountriesController::class);

    Route::resource('Leagues', LeaguesController::class);
        Route::get('Leagues/index_list/{countries_id}', 
            'LeaguesController@index_list')
            ->name('Leagues.index_list');

        Route::get('Leagues/create/{countries_id}', 
            'LeaguesController@create')
            ->name('Leagues.create');


    Route::resource('Clubs', ClubsController::class);
        Route::get('Clubs/index_list/{countries_id}', 
            'ClubsController@index_list')
            ->name('Clubs.index_list');

    Route::resource('Club_leagues', Club_leaguesController::class);
        Route::get('Club_leagues/index_list/{leagues_id}', 
            'Club_leaguesController@index_list')
            ->name('Club_leagues.index_list');

        Route::get('Club_leagues/corner_stats/{leagues_id}', 
            'Club_leaguesController@corner_stats')
            ->name('Club_leagues.corner_stats');

        Route::get('Club_leagues/corner_wdl/{leagues_id}', 
            'Club_leaguesController@corner_wdl')
            ->name('Club_leagues.corner_wdl');

        Route::get('Club_leagues/card_stats/{leagues_id}', 
            'Club_leaguesController@card_stats')
            ->name('Club_leagues.card_stats');

        Route::get('Club_leagues/create/{leagues_id}', 
            'Club_leaguesController@create')
            ->name('Club_leagues.create');
            
        Route::get('Club_leagues/calibrate/{leagues_id}', 
            'Club_leaguesController@calibrate')
            ->name('Club_leagues.calibrate');



    Route::resource('Fixtures', FixturesController::class);
        Route::get('Fixtures/index_list/{leagues_id}', 
            'FixturesController@index_list')
            ->name('Fixtures.index_list');

        Route::get('Fixtures/create/{leagues_id}', 
            'FixturesController@create')
            ->name('Fixtures.create');
    
        Route::get('Fixtures/calibrate/{leagues_id}', 
            'FixturesController@calibrate')
            ->name('Fixtures.calibrate');


    Route::resource('Multirawfixtures', MultirawfixturesController::class);
        Route::get('Multirawfixtures/create/{leagues_id}', 
            'MultirawfixturesController@create')
            ->name('Multirawfixtures.create');

    Route::resource('Multirawclubleagues', MultirawclubleaguesController::class);
        Route::get('Multirawclubleagues/create/{leagues_id}', 
            'MultirawclubleaguesController@create')
            ->name('Multirawclubleagues.create');

    Route::resource('Postmatch', PostmatchController::class);

    Route::resource('Mybet', MybetController::class);
    Route::resource('Cornerkick', CornerkickController::class);

    Route::resource('Archives', ArchivesController::class);
        Route::get('Archives/index_list/{leagues_id}', 
            'ArchivesController@index_list')
            ->name('Archives.index_list');
            
        Route::get('Archives/create/{fixture_id}', 
            'ArchivesController@create')
            ->name('Archives.create');


    Route::resource('Postrawmatch', PostrawmatchController::class);
        Route::get('Postrawmatch/create/{leagues_id}', 
            'PostrawmatchController@create')
            ->name('Postrawmatch.create');


    Route::resource('Histories', HistoriesController::class);
    
    Route::resource('Dashboard', DashboardController::class);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
