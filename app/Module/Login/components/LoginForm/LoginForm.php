<?php declare(strict_types = 1);

namespace App\Module\Login\components\LoginForm;

use App\Model\Facade\Auth\AuthorizationFacade;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;

final class LoginForm
{

	private const LOGIN_ERROR = "Wrong nickname or password";


	public function __construct(
		private readonly AuthorizationFacade $authorizationFacade
	) {}


	public function getLoginForm(IOnSaveEvent $event): Form
	{
		$form = new Form();
		$form->addText("nickname", "nickname")->setRequired();
		$form->addPassword("password", "password")->setRequired();
		$form->addSubmit("login", "login");
		$form->onSuccess[] = function (\Nette\Application\UI\Form $form, LoginFormData $values) use ($event): void
		{
			$valuesArray = $values->toArray();
			try {
				$this->authorizationFacade->login($valuesArray["nickname"], $valuesArray["password"]);
				$event->fire();
			} catch (AuthenticationException $e) {
				$form->addError(self::LOGIN_ERROR);
			}
		};

		return $form;
	}

}
