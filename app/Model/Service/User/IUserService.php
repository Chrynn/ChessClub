<?php declare(strict_types = 1);

namespace App\Model\Service\User;

use App\Model\Database\Entity\UserEntity;

interface IUserService
{

	public function editSettings(array $values): void;

	/**
	 * @param $values array<string, mixed>
	 */
	public function editPassword(array $values): void;

	public function getUserById(int $userId): ?UserEntity;

}
