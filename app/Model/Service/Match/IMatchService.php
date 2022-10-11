<?php declare(strict_types = 1);

namespace App\Model\Service\Match;

use App\Model\Database\Entity\MatchEntity;

interface IMatchService
{

	public function getWinsByUser(int $userId): ?int;

	public function getLosesByUser(int $userId): ?int;

	public function getWinsAsBlackByUser(int $userId): ?int;

	public function getWinsAsWhiteByUser(int $userId): ?int;

	public function getBestGameByUser(int $userId): ?MatchEntity;

	public function getBestMatch(): ?MatchEntity;

	public function getWorstMatch(): ?MatchEntity;

}
