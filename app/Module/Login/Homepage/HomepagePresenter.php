<?php declare(strict_types = 1);

namespace App\Module\Login\Homepage;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Module\Login\components\LoginForm\IOnSaveEvent;
use App\Module\Login\components\LoginForm\LoginFormFactory;
use App\Module\Login\LoginPresenter;
use Nette\Application\UI\Form;

class HomepagePresenter extends LoginPresenter
{

	public function __construct(
		private readonly LoginFormFactory $loginFormFactory,
		private readonly AuthorizationFacade $authorizationFacade
	)
	{
		parent::__construct($this->authorizationFacade);
	}


	public function createComponentLoginForm(): Form
	{
		$event = new class ($this) implements IOnSaveEvent {

			public function __construct(
				private readonly HomepagePresenter $presenter
			) {}

			public function fire(): void
			{
				$this->presenter->flashMessage("Successfully logged in, welcome!");
				$this->presenter->redirect(":User:Homepage:");
			}

		};
		$loginForm = $this->loginFormFactory->create();

		return $loginForm->getLoginForm($event);
	}

}
