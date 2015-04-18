<?php

// Database Stuff
$servername = '<redacted>';
$database = '<redacted>';
$username = '<redacted>';
$password = '<redacted>';

// Riot API Helpers
$apiKey = '<redacted>';
$regions = ['https://br.api.pvp.net/api/lol/br', 'https://eune.api.pvp.net/api/lol/eune', 'https://euw.api.pvp.net/api/lol/euw', 'https://kr.api.pvp.net/api/lol/kr', 'https://lan.api.pvp.net/api/lol/lan', 'https://las.api.pvp.net/api/lol/las', 'https://na.api.pvp.net/api/lol/na',  'https://oce.api.pvp.net/api/lol/oce', 'https://ru.api.pvp.net/api/lol/ru', 'https://tr.api.pvp.net/api/lol/tr'];
$regionIdentifiers = ['br', 'eune', 'euw', 'kr', 'lan', 'las', 'na', 'oce', 'ru', 'tr'];

$regionUrls = array();
for ($i = 0; $i < sizeof($regions); $i++) {
    $regionUrl = $regions[$i];
    $regionIdentifier = $regionIdentifiers[$i];
    $regionUrls[$regionIdentifier] = $regionUrl;
}

// Go ahead and make the DB connection
$challenge_database = new mysqli($servername, $username, $password, $database);
if ($challenge_database->connect_errno) {
        die("connection failed");
}

$GLOBALS['challenge_database'] = $challenge_database;
$GLOBALS['regionIdentifiers'] = $regionIdentifiers;
?>
