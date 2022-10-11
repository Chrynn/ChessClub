<?php declare(strict_types = 1);

namespace App\Module\User\Settings\SettingsForm;

use App\Model\Service\User\UserService;
use Nette\Application\UI\Form;

final class SettingsForm
{

	public function __construct(
		private readonly UserService $userService
	) {}


	public function getSettingsForm(IOnSaveEvent $event, ?int $userId): Form
	{
		$form = new Form();
		$form->addGroup();
		$form->addText("nickname", "nickname")->setHtmlAttribute("class", "small readonly")->setHtmlAttribute("readonly");

		$form->addGroup();
		$form->addText("forename", "forename");
		$form->addText("surname", "surname");

		$form->addGroup();
		$form->addText("number", "phone number")->setHtmlAttribute("class", "small")->addRule($form::FLOAT, "Must be number");

		$form->addGroup();
		$form->addSubmit("save", "Save");
		$form->onSuccess[] = function (Form $form, SettingsFormData $values) use ($event, $userId): void
		{
			$valuesArray = $values->toArray();
			$valuesArray["id"] = $userId;
			$this->userService->editSettings($valuesArray);
			$event->fire();
		};

		return $form;
	}

}
