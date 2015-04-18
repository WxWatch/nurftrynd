<?php

require_once('dbFunctions.php');

$database = $GLOBALS['db'];
$regionUrls = $GLOBALS['regionUrls'];

	if($result = $database->query('SELECT * FROM `challenge_games`')) {
		if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // Get match details
                $region = $row['region'];
                $matchId = $row['matchId'];
                
                if(!matchExists($matchId, $region)) {
                    $reg = $regionUrls[$region];
                    $matchDetailUrl = $reg . '/v2.2/match/' . $matchId . '?api_key=' . $GLOBALS['apiKey'];
                    $mdJson = file_get_contents($matchDetailUrl);
                    $mdObj = json_decode($mdJson);
                    saveMatchDetail($mdObj);
                    echo "Saved Match Detail for match ID " . $matchId . ' in ' . $region . "\n";
                }
            }
        } else {
            echo "0 results";
        }
	} else {
        echo $database->error;
    }
?>
