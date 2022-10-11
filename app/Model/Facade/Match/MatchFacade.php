<?php declare(strict_types = 1);

namespace App\Model\Service\Match;

final class MatchFacade implements IMatchFacade
{

	/**
	 * @param $match array<string, mixed>
	 * @return array<string, mixed>
	 */
	public function getMatchResult(array $match): array
	{
		$playerOne = $match["playerOne"];
		$playerTwo = $match["playerTwo"];
		$playerOneColor = $match["playerOneColor"];
		$playerTwoColor = $match["playerTwoColor"];
		$playerOneMoves = $match["playerOneMoves"];
		$playerTwoMoves = $match["playerTwoMoves"];

		if ($playerOneMoves > $playerTwoMoves) {
			$playerWon = $playerOne;
			$playerLost = $playerTwo;
			$playerWonMoves = $playerOneMoves;
			$playerLostMoves = $playerTwoMoves;
			$playerWonColor = $playerOneColor;
			$playerLostColor = $playerTwoColor;
		} else {
			$playerWon = $playerTwo;
			$playerLost = $playerOne;
			$playerWonMoves = $playerTwoMoves;
			$playerLostMoves = $playerOneMoves;
			$playerWonColor = $playerTwoColor;
			$playerLostColor = $playerOneColor;
		}

		return [
			"playerWon" => $playerWon,
			"playerLost" => $playerLost,
			"playerWonMoves" => $playerWonMoves,
			"playerLostMoves" => $playerLostMoves,
			"playerWonColor" => $playerWonColor,
			"playerLostColor" => $playerLostColor
		];
	}

}
