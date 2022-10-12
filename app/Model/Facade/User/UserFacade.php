<?php declare(strict_types = 1);

namespace App\Model\Facade\User;

use App\Model\Service\User\UserService;

final class UserFacade implements IUserFacade
{

	public function __construct(
		private readonly UserService $userService
	) {}


	/**
	 * @return array<string, int>
	 */
	public function getStatsResult(int $userId): array
	{
		return [
			"wins" => $this->userService->getWinCountByUser($userId) ?? 0,
			"loses" => $this->userService->getLoseCountByUser($userId) ?? 0,
			"winsAsBlack" => $this->userService->getWinsAsBlackByUser($userId) ?? 0,
			"winsAsWhite" => $this->userService->getWinsAsWhiteByUser($userId) ?? 0
		];
	}

}
