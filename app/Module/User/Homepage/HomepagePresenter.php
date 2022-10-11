<?php declare(strict_types = 1);

namespace App\Module\User\Homepage;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Model\Service\Match\MatchService;
use App\Model\Service\User\UserService;
use App\Module\User\UserPresenter;

class HomepagePresenter extends UserPresenter
{

	public function __construct(
		private readonly AuthorizationFacade $authorizationFacade,
		private readonly MatchService $matchService,
		private readonly UserService $userService,
	)
	{
		parent::__construct($authorizationFacade);
	}


	public function actionDefault(): void
	{
		$loggedUserId = $this->authorizationFacade->getLoggedUser()->getId();
		$this->getTemplate()->userStats = $this->getStatsProperly($loggedUserId);
		$this->getTemplate()->userBest = $this->getBestProperly($loggedUserId);
	}


	/**
	 * @return array<string, int>
	 */
	public function getStatsProperly(int $userId): array
	{
		return [
			"wins" => $this->matchService->getWinsByUser($userId) ?? 0,
			"loses" => $this->matchService->getLosesByUser($userId) ?? 0,
			"winsAsBlack" => $this->matchService->getWinsAsBlackByUser($userId) ?? 0,
			"winsAsWhite" => $this->matchService->getWinsAsWhiteByUser($userId) ?? 0
		];
	}


	/**
	 * @return array<string, mixed>
	 */
	public function getBestProperly(int $userId): array
	{
		$bestGame = $this->matchService->getBestGameByUser($userId);
		if ($bestGame !== NULL) {
			$playerWon = $bestGame->getPlayerWon();
			$playerLost = $bestGame->getPlayerLost();

			return [
				"playerWon" => $this->userService->getUserById($playerWon),
				"playerLost" => $this->userService->getUserById($playerLost),
				"playerWonMoves" => $bestGame->getPlayerWonMoves(),
				"playerLostMoves" => $bestGame->getPlayerLostMoves(),
				"playerWonColor" => $bestGame->getPlayerWonColor(),
				"playerLostColor" => $bestGame->getPlayerLostColor()
			];
		} else {
			return [];
		}

	}

}
