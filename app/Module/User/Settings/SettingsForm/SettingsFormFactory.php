<?php declare(strict_types = 1);

namespace App\Module\User\Settings\SettingsForm;

interface SettingsFormFactory
{

	public function create(): SettingsForm;

}
