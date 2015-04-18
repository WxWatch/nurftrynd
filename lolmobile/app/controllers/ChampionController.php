<?php

class ChampionController extends BaseController {

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

    public function index()
    {

    }

    public function allChampions($region)
    {
        return "Region: " . $region;
    }
	
	public function singleChampion($region, $id)
	{
		return Response::json(array('Region' => $region, 'Id' => $id));
	}
}
