<?php

require_once('config.php');

function matchExists($matchId, $regionId) {
    $database = $GLOBALS['db'];

	// Check if match does not already exist
	$query = 'SELECT * FROM challenge_matchdetail WHERE matchId=' . $matchDetail->matchId . ' AND region=' . "'$matchDetail->region'";
	if($result = $database->query($query)) {
		if($result->num_rows == 0) {
			return true;
		}
	}
    return false;
}

function saveMatchId($matchId, $regionId) {
	$database = $GLOBALS['db'];

	if($result = $database->query('SELECT * FROM challenge_games WHERE matchId=' . $matchId . ' AND region=' . "'$regionId'")) {
		if($result->num_rows == 0) {
			$database->query("INSERT INTO challenge_games (matchId, region) VALUES ($matchId, '$regionId')");
		}
	}

}

function saveMatchDetail($matchDetail) {
	$database = $GLOBALS['db'];

    // Insert and do all the cool stuff
    $database->query("INSERT INTO challenge_matchdetail (mapId, matchCreation, matchDuration, matchMode, matchType, matchVersion, platformId, queueType, region, season, matchId) VALUES ($matchDetail->mapId, $matchDetail->matchCreation, $matchDetail->matchDuration, '$matchDetail->matchMode', '$matchDetail->matchType', '$matchDetail->matchVersion', '$matchDetail->platformId', '$matchDetail->queueType', '$matchDetail->region', '$matchDetail->season', $matchDetail->matchId)");
    
    saveMatchParticipants($matchDetail);
    saveParticipantsRunesAndMasteries($matchDetail);
    saveParticipantsStats($matchDetail);
    saveMatchTeams($matchDetail);
    saveTeamsBannedChampions($matchDetail);

}

function saveMatchParticipants($matchDetail) {
	$database = $GLOBALS['db'];
	
	foreach($matchDetail->participants as $participant) {
		$query = "INSERT INTO challenge_participant (championId, highestAchievedSeasonTier, participantId, spell1Id, spell2Id, teamId, matchId) VALUES ($participant->championId, '$participant->highestAchievedSeasonTier', $participant->participantId, $participant->spell1Id, $participant->spell2Id, $participant->teamId, $matchDetail->matchId)";
		$database->query($query);
	}
    
    
}

function saveParticipantsRunesAndMasteries($matchDetail) {
    $database = $GLOBALS['db'];
    
    foreach($matchDetail->participants as $participant) {
        if($participant->masteries) {
            foreach($participant->masteries as $mastery) {
                $query = "INSERT INTO challenge_mastery (masteryId, rank, matchId, participantId) VALUES ($mastery->masteryId, $mastery->rank, $matchDetail->matchId, $participant->participantId)";
                $database->query($query);
            }
        }
        
        if($participant->runes) {
            foreach($participant->runes as $rune) {
                $query = "INSERT INTO challenge_rune (rank, runeId, matchId, participantId) VALUES ($rune->rank, $rune->runeId, $matchDetail->matchId, $participant->participantId)";
                $database->query($query);
            }
        }
        
    }
}

function saveParticipantsStats($matchDetail) {
    $database = $GLOBALS['db'];
    
    foreach($matchDetail->participants as $participant) {
        $stats = $participant->stats;
        $firstBloodAssist = $stats->firstBloodAssist ? 1 : 0;
        $firstBloodKill = $stats->firstBloodKill ? 1 : 0;
        $firstInhibitorAssist = $stats->firstInhibitorAssist ? 1 : 0;
        $firstInhibitorKill = $stats->firstInhibitorKill ? 1 : 0;
        $firstTowerAssist = $stats->firstTowerAssist ? 1 : 0;
        $firstTowerKill = $stats->firstTowerKill ? 1 : 0;
        $winner = $stats->winner ? 1 : 0;
        
        $query = "INSERT INTO challenge_participantstats (matchId, participantId, assists, champLevel, deaths, doubleKills, firstBloodAssist, firstBloodKill, firstInhibitorAssist, firstInhibitorKill, firstTowerAssist, firstTowerKill, goldEarned, goldSpent, inhibitorKills, item0, item1, item2, item3, item4, item5, item6, killingSprees, kills, largestCriticalStrike, largestKillingSpree, largestMultiKill, magicDamageDealt, magicDamageDealtToChampions, magicDamageTaken, minionsKilled, neutralMinionsKilled, neutralMinionsKilledEnemyJungle, neutralMinionsKilledTeamJungle, pentaKills, physicalDamageDealt, physicalDamageDealtToChampions, physicalDamageTaken, quadraKills, sightWardsBoughtInGame, totalDamageDealt, totalDamageDealtToChampions, totalDamageTaken, totalHeal, totalTimeCrowdControlDealt, totalUnitsHealed, towerKills, tripleKills, trueDamageDealt, trueDamageDealtToChampions, trueDamageTaken, unrealKills, visionWardsBoughtInGame, wardsKilled, wardsPlaced, winner) VALUES ($matchDetail->matchId, $participant->participantId, $stats->assists, $stats->champLevel, $stats->deaths, $stats->doubleKills, $firstBloodAssist, $firstBloodKill, $firstInhibitorAssist, $firstInhibitorKill, $firstTowerAssist, $firstTowerKill, $stats->goldEarned, $stats->goldSpent, $stats->inhibitorKills, $stats->item0, $stats->item1, $stats->item2, $stats->item3, $stats->item4, $stats->item5, $stats->item6, $stats->killingSprees, $stats->kills, $stats->largestCriticalStrike, $stats->largestKillingSpree, $stats->largestMultiKill, $stats->magicDamageDealt, $stats->magicDamageDealtToChampions, $stats->magicDamageTaken, $stats->minionsKilled, $stats->neutralMinionsKilled, $stats->neutralMinionsKilledEnemyJungle, $stats->neutralMinionsKilledTeamJungle, $stats->pentaKills, $stats->physicalDamageDealt, $stats->physicalDamageDealtToChampions, $stats->physicalDamageTaken, $stats->quadraKills, $stats->sightWardsBoughtInGame, $stats->totalDamageDealt, $stats->totalDamageDealtToChampions, $stats->totalDamageTaken, $stats->totalHeal, $stats->totalTimeCrowdControlDealt, $stats->totalUnitsHealed, $stats->towerKills, $stats->tripleKills, $stats->trueDamageDealt, $stats->trueDamageDealtToChampions, $stats->trueDamageTaken, $stats->unrealKills, $stats->visionWardsBoughtInGame, $stats->wardsKilled, $stats->wardsPlaced, $winner)";
        
        $database->query($query);
    }
}

function saveMatchTeams($matchDetail) {
	$database = $GLOBALS['db'];
	
	foreach($matchDetail->teams as $team) {
        $firstBaron = $team->firstBaron ? 1 : 0;
        $firstBlood = $team->firstBlood ? 1 : 0;
        $firstDragon = $team->firstDragon ? 1 : 0;
        $firstInhibitor = $team->firstInhibitor ? 1 : 0;
        $firstTower = $team->firstTower ? 1 : 0;
        $winner = $team->winner ? 1 : 0;
        
		$query = "INSERT INTO challenge_team (baronKills, dragonKills, firstBaron, firstBlood, firstDragon, firstInhibitor, firstTower, inhibitorKills, teamId, towerKills, winner, matchId) VALUES ($team->baronKills, $team->dragonKills, $firstBaron, $firstBlood, $firstDragon, $firstInhibitor, $firstTower, $team->inhibitorKills, $team->teamId, $team->towerKills, $winner, $matchDetail->matchId)";
		$database->query($query);

	}
}

function saveTeamsBannedChampions($matchDetail) {
    $database = $GLOBALS['db'];
    
    foreach($matchDetail->teams as $team) {
        foreach($team->bans as $ban) {
            $query = "INSERT INTO challenge_bannedchampion (championId, pickTurn, matchId, teamId) VALUES ($ban->championId, $ban->pickTurn, $matchDetail->matchId, $team->teamId)";
            $database->query($query);
        }
    }
}

?>
