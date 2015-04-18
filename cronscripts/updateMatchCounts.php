<?php

require_once('dbFunctions.php');

$database = $GLOBALS['db'];

$query = "SELECT challenge_participant.championId, challenge_matchdetail.region FROM challenge_participant, challenge_matchdetail WHERE challenge_matchdetail.matchId=challenge_participant.matchId";

$result = $database->query($query);

$counts = Array();

while($row = $result->fetch_assoc()) {
	$region = $row['region'];
	$championId = $row['championId'];
	
	$counts[$championId][$region] += 1;
}

print_r($counts);

foreach($counts as $championId=>$regionArray) {
	$query = "REPLACE INTO challenge_counts SET ";
	$total = 0;
	foreach($regionArray as $region=>$count) {
		$query .= "$region=$count, ";
		$total += $count;
	}
	
	$query .= "world=$total, ";
	$query .= "championId=$championId ";
	
	echo $query . "\n";
	$database->query($query);
}

echo $database->error;
?>
