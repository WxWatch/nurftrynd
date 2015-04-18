<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('urftrynd/halloffame/{region?}', function($region = null)
{
	return View::make('halloffame')->withRegion($region);
});

Route::get('urftrynd/{region?}', function($region = null)
{
	return View::make('challenge')->withRegion($region);
});

Route::group(array('prefix' => 'challenge/api/v1'), function()
{
    Route::group(array('prefix' => 'champions'), function()
    {
        Route::resource('played', 'ChallengeController@championCounts');
        Route::resource('banned', 'ChallengeController@bannedChampionCounts');
        Route::resource('best', 'ChallengeController@bestChampions');
    });
});
