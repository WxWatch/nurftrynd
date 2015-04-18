<?php

$servername = 'localhost';
$database = 'james_lolmobile';
$username = 'james_lolmobile';
$password = 'nrGnWUT6HtuMSMz7bgZ7f6vuDruYuz';

$regions = ['https://br.api.pvp.net/api/lol/br', 'https://eune.api.pvp.net/api/lol/eune', 'https://euw.api.pvp.net/api/lol/euw', 'https://kr.api.pvp.net/api/lol/kr', 'https://lan.api.pvp.net/api/lol/lan', 'https://las.api.pvp.net/api/lol/las', 'https://na.api.pvp.net/api/lol/na',  'https://oce.api.pvp.net/api/lol/oce', 'https://ru.api.pvp.net/api/lol/ru', 'https://tr.api.pvp.net/api/lol/tr'];
$regionIdentifiers = ['br', 'eune', 'euw', 'kr', 'lan', 'las', 'na', 'oce', 'ru', 'tr'];

$db = new mysqli($servername, $username, $password, $database);
if ($db->connect_errno) {
	die("connection failed");
}

function addToDatabase($matchId, $regionId) {
	$data = $GLOBALS['db'];

	if($result = $data->query('SELECT * FROM challenge_games WHERE matchId=' . $matchId . ' AND region=' . "'$regionId'")) {
		if($result->num_rows == 0) {
			$GLOBALS['db']->query("INSERT INTO challenge_games (matchId, region) VALUES ($matchId, '$regionId')");
		}
	}

}

function updateMatches() {
	$now = time() - (5 * 60 * 60);
	$lower_five = floor($now/300)*300;

	$regs = $GLOBALS['regions'];
	$regIds = $GLOBALS['regionIdentifiers'];

	for ($i = 0; $i < sizeof($regs); $i++) {
		$reg = $regs[$i];
		$regionIdentifier = $regIds[$i];
		
	
		$url = $reg . '/v4.1/game/ids?beginDate=' . $lower_five  . '&api_key=0f72f807-0e6d-445c-9d05-61398a15cd2c';
		$json = file_get_contents($url);
		$obj = json_decode($json);
	
		foreach($obj as $matchId) {
			addToDatabase($matchId, $regionIdentifier);
		}

		echo "Added " . sizeof($obj) . " match(es) for the " . $regionIdentifier . " region\n\r";
	}
}

updateMatches();

?>
