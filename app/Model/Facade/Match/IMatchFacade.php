<?php declare(strict_types = 1);

namespace App\Model\Service\Match;

interface IMatchFacade
{

	/**
	 * @param $match array<string, mixed>
	 * @return array<string, mixed>
	 */
	public function getMatchResult(array $match): array;

}
