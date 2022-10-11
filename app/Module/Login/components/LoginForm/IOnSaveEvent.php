<?php declare(strict_types = 1);

namespace App\Module\Login\components\LoginForm;

interface IOnSaveEvent
{

	public function fire(): void;

}
