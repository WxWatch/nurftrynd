<?php

require_once('dbFunctions.php');

$database = $GLOBALS['db'];

$championText = file_get_contents("http://ddragon.leagueoflegends.com/cdn/5.6.1/data/en_US/champion.json");
$json = json_decode($championText);

foreach($json->data as $champion) {
	$championId = $champion->key;
	$name = $champion->name;
	$title = $champion->title;
	$imageName = $champion->image->full;
	
	echo "$championId - $name - $title - $imageName\n";
	
	$query = "REPLACE INTO challenge_championinfo (championId, name, title, imageName) VALUES ($championId, \"$name\", \"$title\", \"$imageName\")";
	$database->query($query);
	echo $database->error . "\n";
}

?>
