<?php

include(app_path().'/includes/statFunctions.php');

class ChallengeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index() {
		return "Test";		
	}
    
    public function championCounts() {
    	$region = Input::get('region');
        $championCounts = getChampionCounts($region);
        return Response::json($championCounts);
    }
    
    public function bannedChampionCounts() {
    	$region = Input::get('region');
        $bannedCounts = getBannedChampionCounts($region);
        return Response::json($bannedCounts);
    }
    
    public function bestChampions() {
        $bestChampions = getChampionHallOfFame();
        return Response::json($bestChampions);
    }

}
