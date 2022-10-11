<?php declare(strict_types = 1);

namespace App\Module\User\Settings\PasswordForm;

final class PasswordFormData
{

	public function __construct(
		public string $password,
	) {}


	/**
	 * @return array<string, string>
	 */
	public function toArray(): array
	{
		return [
			"password" => $this->password
		];
	}

}
