<?php

include(app_path().'/includes/config.php');

function getTopChampion($region) {
	$database = $GLOBALS['challenge_database'];
	
	if ($region == null) {
		$query = "SELECT championId, world FROM challenge_counts ORDER BY world DESC LIMIT 1";
	} else {
		if(in_array(strtolower($region), $GLOBALS['regionIdentifiers'])) {
			$query = "SELECT championId, $region FROM challenge_counts ORDER BY $region DESC LIMIT 1";
		} else {
			$query = "SELECT championId, world FROM challenge_counts ORDER BY world DESC LIMIT 1";
		}
	}
	
	$results = $database->query($query);
	$row = $results->fetch_array(MYSQLI_NUM);
	
	$championId = $row[0];
	$count = $row[1];
	$championInfo = getChampionInfo($championId);	

	$detail['count'] = $count;
	$detail['total'] = getGameCount($region);
	$detail['champion'] = $championInfo;
	
	return $detail;
}

function getChampionInfo($championId) {
	$database = $GLOBALS['challenge_database'];
	
	$query = 'SELECT championId, name, title, imageName FROM challenge_championinfo WHERE championId=?';
	$stmt = $database->prepare($query);
	$stmt->bind_param('i', $championId);
	$stmt->execute();
	$stmt->bind_result($championId, $name, $title, $imageName);
	$stmt->fetch();
	
	return Array('championId'=>$championId, 'name'=>$name, 'title'=>$title, 'imageName'=>$imageName);
}

function getChampionName($championId) {
	$database = $GLOBALS['challenge_database'];
	
	$query = 'SELECT name FROM challenge_championinfo WHERE championId=?';
	$stmt = $database->prepare($query);
	$stmt->bind_param('i', $championId);
	$stmt->execute();
	$stmt->bind_result($name);
	$stmt->fetch();
	
	return $name;
}

function getGameCount($region) {
	$database = $GLOBALS['challenge_database'];

	$query = 'SELECT COUNT(matchId) FROM challenge_matchdetail';
	
	if($region != null) {
		$query .= ' WHERE region=?';
		$stmt = $database->prepare($query);
		$stmt->bind_param('s', $region);
	} else {
		$stmt = $database->prepare($query);
	}
	
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	
	return $count;
}

function getChampionsAllCount($region) {
	$database = $GLOBALS['challenge_database'];
	
	if ($region == null) {
		$query = "SELECT championId, world FROM challenge_counts ORDER BY world DESC";
	} else {
		if(in_array(strtolower($region), $GLOBALS['regionIdentifiers'])) {
			$query = "SELECT championId, $region FROM challenge_counts ORDER BY $region DESC";
		} else {
			$query = "SELECT championId, world FROM challenge_counts ORDER BY world DESC";
		}
	}
	
	$results = $database->query($query);
	$total = 0;
	$counts = Array();
	while($row = $results->fetch_array(MYSQLI_NUM)) {
		$champName = getChampionName($row[0]);
		$count = $row[1];
		$detail['count'] = $count;
		$detail['imageName'] = 
		$total += $count;
		$counts['champions'][$champName] = $count;
	}
	
	$counts['total'] = getGameCount($region);
	
	return $counts;
}

function getChampionGameCount($championId, $region) {
	$database = $GLOBALS['challenge_database'];
	$query = "SELECT world FROM challenge_counts WHERE championId=$championId";
	if($region != null) {
		if(in_array(strtolower($region), $GLOBALS['regionIdentifiers'])) {
			$query = "SELECT $region FROM challenge_counts WHERE championId=$championId";
		}
	}
	$results = $database->query($query)->fetch_array(MYSQLI_NUM);
	return $results[0];
}

function getMatchesInRegion($region) {
	$matchIds = null;
    if($region != null && in_array(strtolower($region), $GLOBALS['regionIdentifiers'])) {
        $database = $GLOBALS['challenge_database'];
    	$query = 'SELECT matchId FROM challenge_matchdetail WHERE region="' . strtoupper($region) . '"';
    	$result = $database->query($query);
    	if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				$matchIds[] = $row['matchId'];
			}
			$result->free();
		}
    }
    return $matchIds;
}

function getCarouselArray() {
	$championCounts = getChampionCounts();
	$highestId = 0;
	$highestCount = 0;
	foreach($championCounts as $key=>$value) {
		if($value > $highestCount) {
			$highestId = $key;
			$highestCount = $value;
		}
	}
		
	return Array('championId'=>$highestId,
					'imageUrl'=>'http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Ezreal_0.jpg',
					'itemId'=>3146);
}

/* 
 * Pick/Ban
 */ 
function getChampionCounts($region) {
	$database = $GLOBALS['challenge_database'];
	
	if ($region == null) {
		$query = "SELECT championId, world FROM challenge_counts ORDER BY world DESC";
	} else {
		if(in_array(strtolower($region), $GLOBALS['regionIdentifiers'])) {
			$query = "SELECT championId, $region FROM challenge_counts ORDER BY $region DESC";
		} else {
			$query = "SELECT championId, world FROM challenge_counts ORDER BY world DESC";
		}
	}
	
	$results = $database->query($query);
	$total = 0;
	$counts = Array();
	while($row = $results->fetch_array(MYSQLI_NUM)) {
		$champId = $row[0];
		$count = $row[1];
		$detail['count'] = $count;
		$total += $count;
		$counts['champions'][$champId] = $count;
	}
	
	$counts['total'] = getGameCount($region);
	
	return $counts;
}

function getBannedChampionCounts($region) {
    $database = $GLOBALS['challenge_database'];
    $counts = array();
    
    if ($region != null && in_array(strtolower($region), $GLOBALS['regionIdentifiers'])) {
	    $query = 'SELECT challenge_bannedchampion.championId FROM challenge_bannedchampion, challenge_matchdetail WHERE challenge_bannedchampion.matchId=challenge_matchdetail.matchId AND challenge_matchdetail.region="' . $region . '" ORDER BY challenge_bannedchampion.championId ASC';
	} else {
	    $query = 'SELECT challenge_bannedchampion.championId FROM challenge_bannedchampion, challenge_matchdetail WHERE challenge_bannedchampion.matchId=challenge_matchdetail.matchId ORDER BY challenge_bannedchampion.championId ASC';
	}
    
    $result = $database->query($query);
    if($result->num_rows > 0) {
       $counts['champions'] = makeCountArrayFromResults($result);
       $result->free();
    }
    
    $counts['total'] = getGameCount($region);
    
    return $counts;
}

function makeCountArrayFromResults($results) {
    $countArray = array();
    while ($row = $results->fetch_assoc()) {
			$championId = $row['championId'];
			if(array_key_exists($championId, $countArray)) {
				$count = $countArray[$championId];
				$count++;
				$countArray[$championId] = $count;
			} else {
				$countArray[$championId] = 1;
			}
    }
    
    return $countArray;
}

/*
 * Items
 */ 
function getItemCounts() {
	$database = $GLOBALS['challenge_database'];
	$counts = array();

	$query = 'SELECT item0, item1, item2, item3, item4, item5 FROM challenge_participantstats';

	$results = $database->query($query);
	$countArray = array();
	$columns = ['item0', 'item1', 'item2', 'item3', 'item4', 'item5'];
	if($results->num_rows > 0) {
		while ($row = $results->fetch_assoc()) {
			foreach($columns as $column) {
				$itemId = $row[$column];
				if(array_key_exists($itemId, $countArray)) {
					$count = $countArray[$itemId];
					$count++;
					$countArray[$itemId] = $count;
				} else {
					$countArray[$itemId] = 1;
				}
			}
		}
  	  	/* free result set */
  		$results->free();
	}
	return $counts;
}

/*
 * Stat-related
 */
function getChampionHallOfFame($region) {
    $statNames = ['magicDamageDealtToChampions', 'physicalDamageDealtToChampions', 'totalDamageDealtToChampions', 'totalHeal', 'trueDamageDealtToChampions'];
    
    $statResults = array();
    
    $matchIds = null;
    if($region != null && in_array(strtolower($region), $GLOBALS['regionIdentifiers'])) {
        $database = $GLOBALS['challenge_database'];
    	$query = 'SELECT matchId FROM challenge_matchdetail WHERE region="' . strtoupper($region) . '"';
    	$result = $database->query($query);
    	if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				$matchIds[] = $row['matchId'];
			}
			$result->free();
		}
    }
    
	$statResults = getChampionWithHighestStat($statNames, $matchIds);
    
    return $statResults;
}

function getChampionWithHighestStat($statNameArray, $matchIds) {
     $database = $GLOBALS['challenge_database'];
    
    $statNames = join(', ', $statNameArray);
	$query = 'SELECT ';
	
	$last = end($statNameArray);
	foreach($statNameArray as $statName) {
		$isEnd = $statName == $last;
		$maxCase[] = 'MAX(CASE WHEN challenge_participantstats.' . $statName . '=mx.' . $statName . ' THEN CONCAT(matchId,",",participantId,",", challenge_participantstats.' . $statName . ') END) ' . $statName . ($isEnd ? ' ' : ', ');
		$inJoinCase[] = 'MAX(' . $statName . ') ' . $statName . ($isEnd ? ' ' : ', ');
		$onCase[] = 'challenge_participantstats.' . $statName . '=mx.' . $statName . ' ';
	}
	
	foreach($maxCase as $case) {
		$query .= $case;
	}
	
	$query .= 'FROM challenge_participantstats ';
	
	if($matchIds != null) {
		foreach($matchIds as $key => $value) {
			$matchArray[$key] = $value;
		}
		$matchIdArray = join(', ', $matchArray);
	}
	
	$query .= 'INNER JOIN (SELECT ';
	
	foreach($inJoinCase as $case) {
		$query .= $case;
	}
	
	$query .= 'FROM challenge_participantstats';
	
	if($matchIds != null){
		$query .= ' WHERE matchId in (' . $matchIdArray . ')';	
	}
	$query .= ') mx ON ';
	
	$last = end($onCase);
	foreach($onCase as $case) {
		$query .= $case;
		if($case != $last) {
			$query .= ' OR ';
		}
	}
	
	if($matchIds != null){
		$query .= ' WHERE matchId in (' . $matchIdArray . ')';	
	}
	
    $result = $database->query($query)->fetch_assoc();
    
    $return = array();
    foreach($statNameArray as $statName) {
    	$maxResult = $result[$statName];
    	$maxArray = explode(',', $maxResult);
    	
    	$matchId = $maxArray[0];
    	$participantId = $maxArray[1];
        $statAmount = $maxArray[2];
        
        // Get the championId
		$query = 'SELECT championId FROM challenge_participant WHERE matchId=' . $matchId . ' AND participantId=' . $participantId;
		$result2 = $database->query($query)->fetch_assoc();
		$championId = $result2['championId'];
	
		$array['championId'] = $championId;
		$array[$statName] = $statAmount;
		$array['amount'] = $statAmount;
		$return[$statName] = $array;
	}    

    return $return;   
}

?>
