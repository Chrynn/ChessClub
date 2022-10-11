<?php declare(strict_types = 1);

namespace App\Module\User\Settings\SettingsForm;

use App\Model\Database\Entity\UserEntity;

final class SettingsFormData
{

	public function __construct(
		public string $nickname,
		public string $forename,
		public string $surname,
		public string|float $number
	) {}


	/**
	 * @return array<string, string>
	 */
	public function toArray(): array
	{
		return [
			"nickname" => $this->nickname,
			"forename" => $this->forename,
			"surname" => $this->surname,
			"number" => (string) $this->number
		];
	}


	/**
	 * @return array<string, string>
	 */
	public static function fillFormByUser(UserEntity $userEntity): array
	{
		return [
			"nickname" => $userEntity->getNickname(),
			"forename" => $userEntity->getForename(),
			"surname" => $userEntity->getSurname(),
			"number" => $userEntity->getNumber()
		];
	}

}
