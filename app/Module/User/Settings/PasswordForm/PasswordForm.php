<?php declare(strict_types = 1);

namespace App\Module\User\Settings\PasswordForm;

use App\Model\Service\User\UserService;
use Nette\Application\UI\Form;

final class PasswordForm
{

	public function __construct(
		private readonly UserService $userService
	) {}


	public function getPasswordForm($event, $userId): Form
	{
		$form = new Form();
		$form->addGroup();
		$form->addText("password", "password")->setRequired("Fill password")->setHtmlAttribute("class", "small");

		$form->addGroup();
		$form->addSubmit("save", "Save");
		$form->onSuccess[] = function (Form $form, PasswordFormData $values) use ($event, $userId): void
		{
			$valuesArray = $values->toArray();
			$valuesArray["id"] = $userId;
			$this->userService->editPassword($valuesArray);
			$event->fire();
		};

		return $form;
	}

}
