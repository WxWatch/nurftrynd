<?php
use LeagueWrap\Api;
include(app_path().'/includes/statFunctions.php');

$championInfo = getTopChampion($region);
$gameCount = $championInfo['count'];
$gameTotal = $championInfo['total'];
$gamePercent = ($gameCount/$gameTotal) * 100;

$name = $championInfo['champion']['name'];
$title = $championInfo['champion']['title'];

$key = explode('.', $championInfo['champion']['imageName'])[0];
$imageUrl = "http://ddragon.leagueoflegends.com/cdn/img/champion/splash/" . $key . "_0.jpg";

$homeActive = "active";

?>

@extends('master')

@section('title', 'Home')
    
@section('content')
	<!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
         <?php echo "<img class='first-slide' src='$imageUrl' alt='First slide'>"; ?>
          <div class="container">
            <div class="carousel-caption">
              <h1><?php echo "$name, $title"; ?></h1>
              <p><?= $name ?> has been chosen in <?php print(number_format($gamePercent, 1) . '% (' . number_format($gameCount) . '/' . number_format($gameTotal) . ')'); ?> of available games.</p>
              <p><a class="btn btn-lg btn-primary" href="<?php echo "halloffame/$region"; ?>" role="button">View Champion Hall of Fame</a></p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.carousel -->
@stop


