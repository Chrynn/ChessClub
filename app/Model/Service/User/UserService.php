<?php declare(strict_types = 1);

namespace App\Model\Service\User;

use App\Model\Database\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Security\Passwords as NettePasswords;

final class UserService implements IUserService
{

	public function __construct(
		private readonly EntityManagerInterface $entityManager,
		private readonly NettePasswords $nettePasswords
	) {}


	public function editSettings(array $values): void
	{
		$userEntity = $this->getUserById($values["id"]);
		$userEntity->setNickname($values["nickname"]);
		$userEntity->setForename($values["forename"] !== "" ? $values["forename"] : NULL);
		$userEntity->setSurname($values["surname"] !== "" ? $values["surname"] : NULL);
		$userEntity->setNumber($values["number"] !== "" ? $values["number"] : NULL);
		$this->entityManager->flush();
	}


	/**
	 * @param $values array<string, mixed>
	 */
	public function editPassword(array $values): void
	{
		$userEntity = $this->getUserById($values["id"]);

		$nettePasswords = $this->nettePasswords;
		$newPassword = $nettePasswords->hash($values["password"]);

		$userEntity->setPassword($newPassword);
	}


	public function getUserById(int $userId): ?UserEntity
	{
		return $this->entityManager->getRepository(UserEntity::class)->findOneBy([
			"id" => $userId,
		]);
	}

}
