<?php declare(strict_types = 1);

namespace App\Module\User;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Module\ModulePresenter;

class UserPresenter extends ModulePresenter
{

	public function __construct(
		private readonly AuthorizationFacade $authorizationFacade
	)
	{
		parent::__construct($this->authorizationFacade);
	}


	protected function startup(): void
	{
		parent::startup();
		$logged = $this->authorizationFacade->isLoggedIn();
		if (!$logged) {
			$this->redirect(":Login:Homepage:");
		}
	}

}
