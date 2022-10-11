<?php declare(strict_types = 1);

namespace App\Module\Login\components\LoginForm;

interface LoginFormFactory
{

	public function create(): LoginForm;

}
