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
		$nettePasswords = $this->nettePasswords;
		$newPassword = $nettePasswords->hash($values["password"]);

		$userEntity = $this->getUserById($values["id"]);
		$userEntity->setPassword($newPassword);
	}


	public function getUserById(int $userId): ?UserEntity
	{
		return $this->entityManager->getRepository(UserEntity::class)->findOneBy([
			"id" => $userId,
		]);
	}


	/**
	 * @return array<int, UserEntity>
	 */
	public function getUsersByWin(int $limit): array
	{
		$number = 10;
		return $this->entityManager->createQueryBuilder()
			->select("u")
			->from(UserEntity::class, "u")
			->where("u.winsAsWhite >= :rule")
			->andWhere("u.winsAsBlack >= :rule")
			->setParameter("rule", $number)
			->orderBy("u.winCount", "DESC")
			->setMaxResults($limit)
			->getQuery()
			->getResult();
	}


	public function getWinCountByUser(int $userId): ?int
	{
		return $this->entityManager->createQueryBuilder()
			->select("u.winCount")
			->from(UserEntity::class, "u")
			->where("u.id = :id")
			->setParameter("id", $userId)
			->getQuery()
			->getSingleScalarResult();
	}


	public function getLoseCountByUser(int $userId): ?int
	{
		return $this->entityManager->createQueryBuilder()
			->select("u.loseCount")
			->from(UserEntity::class, "u")
			->where("u.id = :id")
			->setParameter("id", $userId)
			->getQuery()
			->getSingleScalarResult();
	}


	public function getWinsAsBlackByUser(int $userId): ?int
	{
		return $this->entityManager->createQueryBuilder()
			->select("u.winsAsBlack")
			->from(UserEntity::class, "u")
			->where("u.id = :id")
			->setParameter("id", $userId)
			->getQuery()
			->getSingleScalarResult();
	}


	public function getWinsAsWhiteByUser(int $userId): ?int
	{
		return $this->entityManager->createQueryBuilder()
			->select("u.winsAsWhite")
			->from(UserEntity::class, "u")
			->where("u.id = :id")
			->setParameter("id", $userId)
			->getQuery()
			->getSingleScalarResult();
	}


	public function setPlayerWin(int $playerId): void
	{
		$playerWonEntity = $this->getUserById($playerId);
		$winCount = $playerWonEntity->getWinCount();
		$playerWonEntity->setWinCount($winCount !== NULL ? $winCount + 1 : 1);
	}


	public function setPlayerLose(int $playerId): void
	{
		$playerLostEntity = $this->getUserById($playerId);
		$loseCount = $playerLostEntity->getLoseCount();
		$playerLostEntity->setLoseCount($loseCount !== NULL ? $loseCount + 1 : 1);
	}


	public function setPlayerWinColor(int $playerId, string $playerColor): void
	{
		$playerWonEntity = $this->getUserById($playerId);
		if ($playerColor === "white") {
			$winAsWhiteCount = $playerWonEntity->getWinsAsWhite();
			$playerWonEntity->setWinsAsWhite($winAsWhiteCount !== NULL ? $winAsWhiteCount + 1 : 1);
		} else {
			$winAsBlackCount = $playerWonEntity->getWinsAsBlack();
			$playerWonEntity->setWinsAsBlack($winAsBlackCount !== NULL ? $winAsBlackCount + 1 : 1);
		}
	}

}
