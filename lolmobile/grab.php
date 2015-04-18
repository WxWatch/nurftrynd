<?php

require_once('dbFunctions.php');

function updateMatches() {
	$now = time() - (5 * 60 * 60);
	$lower_five = floor($now/300)*300;

	$regs = $GLOBALS['regions'];
	$regIds = $GLOBALS['regionIdentifiers'];

	for ($i = 0; $i < sizeof($regs); $i++) {
		$reg = $regs[$i];
		$regionIdentifier = $regIds[$i];
		
		$url = $reg . '/v4.1/game/ids?beginDate=' . $lower_five  . '&api_key=' . $GLOBALS['apiKey'];
		$json = file_get_contents($url);
		$obj = json_decode($json);
	
		foreach($obj as $matchId) {
            if(!matchExists($matchId, $regionIdentifier)) {
                saveMatchId($matchId, $regionIdentifier);
                
                // Get match details
                $matchDetailUrl = $reg . '/v2.2/match/' . $matchId . '?api_key=' . $GLOBALS['apiKey'];
                $mdJson = file_get_contents($matchDetailUrl);
                $mdObj = json_decode($mdJson);
                
                saveMatchDetail($mdObj);
                
            }
		}

		echo "Added " . sizeof($obj) . " match(es) for the " . $regionIdentifier . " region\n\r";
	}
}

updateMatches();


?>
