<?php declare(strict_types = 1);

namespace App\Module\User\Settings\PasswordForm;

interface PasswordFormFactory
{

	public function create(): PasswordForm;

}