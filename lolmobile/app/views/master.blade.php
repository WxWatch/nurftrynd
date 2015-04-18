<!-- Stored in resources/views/layouts/master.blade.php -->

<?php
	if(!isset($homeActive)) $homeActive = '';
	if(!isset($hofActive)) $hofActive = '';
	if(!isset($aboutActive)) $aboutActive = '';
?>

<html>
    <head>
        <title>URF Trynd - @yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        {{ HTML::style('css/main.css'); }}
    </head>
    <body>

            @section('top-nav')
			  <nav class="navbar navbar-inverse navbar-fixed-top">
				  <div class="container">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="http://lolmobile.net/urftrynd/">URF Trynd</a>
					</div>
					<div id="navbar" class="collapse navbar-collapse">
          				<ul class="nav navbar-nav pull-right">
            				<li class="<?= $homeActive ?>"><a href="<?php echo "http://lolmobile.net/urftrynd/$region"; ?>">Home</a></li>
            				<li class="<?= $hofActive ?>"><a href="<?php echo "http://lolmobile.net/urftrynd/halloffame/$region"; ?>">Hall of Fame</a></li>
            				<li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Region (<?php echo $region == null ? "ALL" : strtoupper($region); ?>) <span class="caret"></span></a>
							  <ul class="dropdown-menu" role="menu">
							  	<li><a href=".">ALL</a></li>
								<li><a href="br">BR</a></li>
								<li><a href="eune">EUNE</a></li>
								<li><a href="kr">KR</a></li>
								<li><a href="lan">LAN</a></li>
								<li><a href="las">LAS</a></li>
								<li><a href="na">NA</a></li>
								<li><a href="oce">OCE</a></li>
								<li><a href="ru">RU</a></li>
								<li><a href="tr">TR</a></li>
							  </ul>
							</li>
							<li class="<?= $aboutActive ?>"><a href="#about">About</a></li>
         				 </ul>
        			</div><!--/.nav-collapse -->
				  </div>
				</nav>
            @show

              @yield('content')
              
              @section('footer')
              <div class="container">
            	<footer>
                  <p>&copy; James Glenn, 2015.</p>
                  <p>URF Trynd/LoL Mobile isn't endorsed by Riot Games and doesn't reflect the views or opinions of Riot Games or anyone officially involved in producing or managing League of Legends. League of Legends and Riot Games are trademarks or registered trademarks of Riot Games, Inc. League of Legends © Riot Games, Inc.</p>
      			</footer>
      		</div>
            @show

        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{ HTML::script('js/ie10-viewport-bug-workaround.js'); }}
    </body>
</html>