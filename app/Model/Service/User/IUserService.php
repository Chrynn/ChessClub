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

	/**
	 * @return array<int, UserEntity>
	 */
	public function getUsersByWin(int $limit): array;

	public function getWinCountByUser(int $userId): ?int;

	public function getLoseCountByUser(int $userId): ?int;

	public function getWinsAsBlackByUser(int $userId): ?int;

	public function getWinsAsWhiteByUser(int $userId): ?int;

	public function setPlayerWin(int $playerId): void;

	public function setPlayerLose(int $playerId): void;

	public function setPlayerWinColor(int $playerId, string $playerColor): void;

}
