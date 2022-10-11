<?php declare(strict_types = 1);

namespace App\Module\User\TopPlayers;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Model\Service\Match\MatchService;
use App\Model\Service\User\UserService;
use App\Module\User\UserPresenter;

class TopPlayersPresenter extends UserPresenter
{

	public function __construct(
		AuthorizationFacade $authorizationFacade,
		private readonly MatchService $matchService,
		private readonly UserService $userService
	)
	{
		parent::__construct($authorizationFacade);
	}


	public function actionDefault(): void
	{
		$this->getTemplate()->bestMatch = $this->getBestMatchProperly();
		$this->getTemplate()->worstMatch = $this->getWorstMatchResult();
	}


	/**
	 * @return array<string, mixed>
	 */
	public function getBestMatchProperly(): array
	{
		$matchEntity = $this->matchService->getBestMatch();
		$playerWon = $matchEntity->getPlayerWon();
		$playerLost = $matchEntity->getPlayerLost();

		return [
			"playerWon" => $this->userService->getUserById($playerWon),
			"playerLost" => $this->userService->getUserById($playerLost),
			"playerWonMoves" => $matchEntity->getPlayerWonMoves(),
			"playerLostMoves" => $matchEntity->getPlayerLostMoves(),
			"date" => $matchEntity->getMatchDate()
		];
	}


	/**
	 * @return array<string, mixed>
	 */
	public function getWorstMatchResult(): array
	{
		$matchEntity = $this->matchService->getWorstMatch();
		$playerWon = $matchEntity->getPlayerWon();
		$playerLost = $matchEntity->getPlayerLost();

		return [
			"playerWon" => $this->userService->getUserById($playerWon),
			"playerLost" => $this->userService->getUserById($playerLost),
			"playerWonMoves" => $matchEntity->getPlayerWonMoves(),
			"playerLostMoves" => $matchEntity->getPlayerLostMoves(),
			"date" => $matchEntity->getMatchDate()
		];
	}

}
