<?php declare(strict_types = 1);

namespace App\Module\User\Leaderboard;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Model\Facade\Match\MatchFacade;
use App\Module\User\UserPresenter;

final class LeaderboardPresenter extends UserPresenter
{

	public function __construct(
		AuthorizationFacade $authorizationFacade,
		private readonly MatchFacade $matchFacade
	)
	{
		parent::__construct(
			$authorizationFacade
		);
	}


	public function actionDefault(): void
	{
		$this->getTemplate()->bestMatch = $this->matchFacade->getBestMatchResult();
		$this->getTemplate()->worstMatch = $this->matchFacade->getWorstMatchResult();
		$this->getTemplate()->topPlayers = $this->matchFacade->getTopPlayersResult();
	}

}
