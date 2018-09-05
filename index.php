<?php 
// start at 18:26
// pause at 19:06 (40 min)
// start at 21:25
// finished at 23:10 (1 hr 45 min)

include_once 'models/Team.php';
include_once 'models/Totals.php';

function entropy() {
	return rand(-10000, 10000) / 10000;
}

function match(int $c1, int $c2) {
	if($c1 === $c2) {
		throw new Exception('Команда не может играть сама с собой');
	}

	$firstTeam = new Team($c1);
	$secondTeam = new Team($c2);

	$averageGoalsCount = Totals::getTotalGoalsScored() / Totals::getTotalGames();

	$firstTeamGoals = $firstTeam->calculateStrength() * $secondTeam->calculateDefence() * $averageGoalsCount + entropy();
	$secondTeamGoals = $secondTeam->calculateStrength() * $firstTeam->calculateDefence() * $averageGoalsCount + entropy();
	
	return [round($firstTeamGoals, 0), round($secondTeamGoals, 0)];
}

?>
