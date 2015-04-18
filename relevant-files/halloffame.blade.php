<?php

include(app_path().'/includes/statFunctions.php');

$hofActive = 'active';

$gameCount = getChampionsAllCount($region);

?>

@extends('master')

@section('title', 'Hall of Fame')
    
@section('content')
<div class="container">
	<h2>Champion Hall of Fame - <?php echo $region == null ? 'World' : strtoupper($region); ?></h2>
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>Champion</th>
				<th># of Games</th>
				<th>% of Total Games</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$total = $gameCount['total'];
			foreach($gameCount['champions'] as $champId=>$count) {
				$gamePercent = ($count/$total) * 100; 
				echo "<tr>";
				echo "<th>$champId</th>";
				echo "<th>". number_format($count) . "</th>";
				echo "<th>" . number_format($gamePercent, 1) . "%</th>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>
</div>
@stop


