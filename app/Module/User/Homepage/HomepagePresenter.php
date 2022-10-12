<?php declare(strict_types = 1);

namespace App\Module\User\Homepage;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Model\Facade\Match\MatchFacade;
use App\Model\Facade\User\UserFacade;
use App\Module\User\UserPresenter;

final class HomepagePresenter extends UserPresenter
{

	public function __construct(
		private readonly AuthorizationFacade $authorizationFacade,
		private readonly UserFacade $userFacade,
		private readonly MatchFacade $matchFacade
	)
	{
		parent::__construct(
			$authorizationFacade
		);
	}


	public function actionDefault(): void
	{
		$loggedUserId = $this->authorizationFacade->getLoggedUser()->getId();

		$this->getTemplate()->userStats = $this->userFacade->getStatsResult($loggedUserId);
		$this->getTemplate()->userBest = $this->matchFacade->getBestGameByUserResult($loggedUserId);
	}

}
