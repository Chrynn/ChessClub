<?php declare(strict_types=1);

namespace App\Module;

use App\Model\Facade\Auth\AuthorizationFacade;
use Nette\Application\UI\Presenter;

abstract class ModulePresenter extends Presenter
{

	private AuthorizationFacade $authorizationFacade;


	public function __construct(
		AuthorizationFacade $authorizationFacade
	)
	{
		parent::__construct();
		$this->authorizationFacade = $authorizationFacade;
	}


	protected function beforeRender()
	{
		parent::beforeRender();
		$loginStatus = $this->authorizationFacade->isLoggedIn();
		if ($loginStatus) {
			$this->getTemplate()->loggedUser = $this->authorizationFacade->getLoggedUser();
		}

		$this->getTemplate()->isLogged = $loginStatus;
	}


	public function handleLogout(): void
	{
		$this->authorizationFacade->logout();
		$this->flashMessage("Successfully logged out, bye!");
		$this->redirect(":Login:Homepage:");
	}


	public function findLayoutTemplateFile(): ?string
	{
		return __DIR__ . '/templates/@layout.latte';
	}

}
