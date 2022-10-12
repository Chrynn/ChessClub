<?php declare(strict_types = 1);

namespace App\Model\Facade\User;

interface IUserFacade
{

	/**
	 * @return array<string, int>
	 */
	public function getStatsResult(int $userId): array;

}