<?php declare(strict_types=1);

namespace App\Module\User\Settings\PasswordForm;

interface IOnSaveEvent
{

	public function fire(): void;

}