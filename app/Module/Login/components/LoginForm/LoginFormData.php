<?php declare(strict_types = 1);

namespace App\Module\Login\components\LoginForm;

final class LoginFormData
{

	public function __construct(
		public string $nickname,
		public string $password
	) {}


	/**
	 * @return array<string, mixed>
	 */
	public function toArray(): array
	{
		return [
			'nickname' => $this->nickname,
			'password' => $this->password,
		];
	}

}
