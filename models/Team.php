<?php 

include_once 'traits/Statistics.php';
include_once 'Totals.php';

class Team
{
	use Statistics;

	public $id;

	public $gamesPlayed;
	public $goalsScored;
	public $goalsSkipped;

    /**
     * Team constructor.
     * @param $id
     * @throws Exception
     */
	public function __construct($id)
	{
		$this->id = $id;
		$this->gamesPlayed = self::$currentStatistics[$this->id]['games'];
		$this->goalsScored = self::$currentStatistics[$this->id]['goals']['scored'];
		$this->goalsSkipped = self::$currentStatistics[$this->id]['goals']['skiped'];

		if(!$this->validate()) {
			throw new Exception('Такого порядкового номера команды нет');
		}
	}

	protected function validate()
	{
		return $this->id < count(self::$currentStatistics);
	}

	public function calculateStrength()
	{
		$teamCoefficient = ($this->goalsScored / $this->gamesPlayed);
		$totalCoefficient = (Totals::getTotalGoalsScored() / Totals::getTotalGames());
		return $teamCoefficient / $totalCoefficient;
	}

	public function calculateDefence()
	{
		$teamCoefficient = ($this->goalsSkipped / $this->gamesPlayed);
		$totalCoefficient = (Totals::getTotalGoalsSkipped() / Totals::getTotalGames());
		return $teamCoefficient / $totalCoefficient;
	}

}