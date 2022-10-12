<?php declare(strict_types=1);

namespace App\Model\Database\Fixture;

use App\Model\Database\Entity\MatchEntity;
use App\Model\Facade\Match\MatchFacade;
use App\Model\Service\User\UserService;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Nette\Neon\Neon;
use Nette\Utils\DateTime;

final class MatchFixture extends OrderFixture implements OrderedFixtureInterface
{

	public function getMatchFacade(): MatchFacade
	{
		return $this->getContainer()->getByType(MatchFacade::class);
	}


	public function getUserFacade(): UserService
	{
		return $this->getContainer()->getByType(UserService::class);
	}


	public function load(ObjectManager $manager): void
	{
		$dateNow = new \DateTime("now");
		$matches = Neon::decodeFile(__DIR__ . '/content/match.neon');

		foreach ($matches as $match) {
			if (array_key_exists("playedAt", $match)) {
				$playedAt = DateTime::createFromImmutable($match["playedAt"]);
			} else {
				$playedAt = $dateNow;
			}
			$matchResult = $this->getMatchFacade()->getMatchResult($match);

			$playerWon = $matchResult["playerWon"];
			$playerLost = $matchResult["playerLost"];
			$playerWonColor = $matchResult["playerWonColor"];

			$this->getUserFacade()->setPlayerWin($playerWon);
			$this->getUserFacade()->setPlayerLose($playerLost);
			$this->getUserFacade()->setPlayerWinColor($playerWon, $playerWonColor);

			$newMatch = new MatchEntity();
			$newMatch->setPlayerWon($playerWon);
			$newMatch->setPlayerLost($playerLost);
			$newMatch->setPlayerWonMoves($matchResult["playerWonMoves"]);
			$newMatch->setPlayerLostMoves($matchResult["playerLostMoves"]);
			$newMatch->setPlayerWonColor($playerWonColor);
			$newMatch->setPlayerLostColor($matchResult["playerLostColor"]);
			$newMatch->setMatchDate($playedAt);

			$manager->persist($newMatch);
		}
		$manager->flush();
	}


	public function getOrder(): int
	{
		return 1;
	}

}
