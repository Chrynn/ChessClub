<?php declare(strict_types = 1);

namespace App\Model\Facade\Match;

interface IMatchFacade
{

	/**
	 * @param $match array<string, mixed>
	 * @return array<string, mixed>
	 */
	public function getMatchResult(array $match): array;

	/**
	 * @return array<string, mixed>|null
	 */
	public function getBestGameByUserResult(int $userId): ?array;

	/**
	 * @return array<string, mixed>|null
	 */
	public function getBestMatchResult(): ?array;

	/**
	 * @return array<string, mixed>|NULL
	 */
	public function getWorstMatchResult(): ?array;

	/**
	 * @return array<string, mixed>|NULL
	 */
	public function getTopPlayersResult(): ?array;

}
