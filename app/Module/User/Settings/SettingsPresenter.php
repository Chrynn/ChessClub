<?php declare(strict_types = 1);

namespace App\Module\User\Settings;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Module\User\Settings\PasswordForm\PasswordFormFactory;
use App\Module\User\Settings\SettingsForm\IOnSaveEvent;
use App\Module\User\Settings\SettingsForm\SettingsFormData;
use App\Module\User\Settings\SettingsForm\SettingsFormFactory;
use App\Module\User\UserPresenter;
use Nette\Application\UI\Form;

final class SettingsPresenter extends UserPresenter
{

	public function __construct(
		private readonly AuthorizationFacade $authorizationFacade,
		private readonly SettingsFormFactory $settingsFormFactory,
		private readonly PasswordFormFactory $passwordFormFactory

	)
	{
		parent::__construct(
			$authorizationFacade
		);
	}


	protected function createComponentSettingsForm(): Form
	{
		$event = new class ($this) implements IOnSaveEvent {

			public function __construct(
				private readonly SettingsPresenter $presenter
			) {}


			public function fire(): void
			{
				$this->presenter->flashMessage("Settings Successfully edited");
				$this->presenter->redirect("this");
			}

		};
		$settingsForm = $this->settingsFormFactory->create();
		$loggedUser = $this->authorizationFacade->getLoggedUser();

		$form = $settingsForm->getSettingsForm($event, $loggedUser->getId());
		$form->onRender[] = static function () use ($form, $loggedUser){
			$form->setDefaults(SettingsFormData::fillFormByUser($loggedUser));
		};

		return $form;
	}


	protected function createComponentPasswordForm(): Form
	{
		$event = new class ($this) implements IOnSaveEvent {

			public function __construct(
				private readonly SettingsPresenter $presenter
			) {}


			public function fire(): void
			{
				$this->presenter->flashMessage("Password successfully edited");
				$this->presenter->redirect("this");
			}

		};
		$loggedUser = $this->authorizationFacade->getLoggedUser();
		$passwordForm = $this->passwordFormFactory->create();

		return $passwordForm->getPasswordForm($event, $loggedUser->getId());
	}

}
