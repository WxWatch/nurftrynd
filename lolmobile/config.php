<?php

// Database Stuff
$servername = 'localhost';
$database = 'james_lolmobile';
$username = 'james_lolmobile';
$password = 'nrGnWUT6HtuMSMz7bgZ7f6vuDruYuz';

// Riot API Helpers
$apiKey = '0f72f807-0e6d-445c-9d05-61398a15cd2c';
$regions = ['https://br.api.pvp.net/api/lol/br', 'https://eune.api.pvp.net/api/lol/eune', 'https://euw.api.pvp.net/api/lol/euw', 'https://kr.api.pvp.net/api/lol/kr', 'https://lan.api.pvp.net/api/lol/lan', 'https://las.api.pvp.net/api/lol/las', 'https://na.api.pvp.net/api/lol/na',  'https://oce.api.pvp.net/api/lol/oce', 'https://ru.api.pvp.net/api/lol/ru', 'https://tr.api.pvp.net/api/lol/tr'];
$regionIdentifiers = ['br', 'eune', 'euw', 'kr', 'lan', 'las', 'na', 'oce', 'ru', 'tr'];

$regionUrls = array();
for ($i = 0; $i < sizeof($regions); $i++) {
    $regionUrl = $regions[$i];
    $regionIdentifier = $regionIdentifiers[$i];
    $regionUrls[$regionIdentifier] = $regionUrl;
}

// Go ahead and make the DB connection
$db = new mysqli($servername, $username, $password, $database);
if ($db->connect_errno) {
        die("connection failed");
}

?>