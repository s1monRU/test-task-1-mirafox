<?php 

include_once 'traits/Statistics.php';

class Totals
{
	use Statistics;

	public static function getTotalGames()
	{
		return array_sum(array_column(self::$currentStatistics, 'games'));
	}

	public static function getTotalGoalsScored()
	{
		return array_sum(array_column(array_column(self::$currentStatistics, 'goals'), 'scored'));
	}

	public static function getTotalGoalsSkipped()
	{
		return array_sum(array_column(array_column(self::$currentStatistics, 'goals'), 'skiped'));
	}
}