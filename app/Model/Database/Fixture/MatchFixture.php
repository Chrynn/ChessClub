<?php declare(strict_types = 1);

namespace App\Model\Database\Fixture;

use App\Model\Database\Entity\MatchEntity;
use App\Model\Service\Match\MatchFacade;
use Doctrine\Persistence\ObjectManager;
use Nette\Neon\Neon;
use Nettrine\Fixtures\ContainerAwareInterface;

final class MatchFixture extends AbstractFixture implements ContainerAwareInterface
{

	public function getMatchFacade(): MatchFacade
	{
		return $this->getContainer()->getByType(MatchFacade::class);
	}


	public function load(ObjectManager $manager): void
	{
		$matches = Neon::decodeFile(__DIR__ . '/content/match.neon');
		$matchDate = new \DateTime("now");

		foreach ($matches as $match) {
			$matchResult = $this->getMatchFacade()->getMatchResult($match);

			$newMatch = new MatchEntity();
			$newMatch->setPlayerWon($matchResult["playerWon"]);
			$newMatch->setPlayerLost($matchResult["playerLost"]);
			$newMatch->setPlayerWonMoves($matchResult["playerWonMoves"]);
			$newMatch->setPlayerLostMoves($matchResult["playerLostMoves"]);
			$newMatch->setPlayerWonColor($matchResult["playerWonColor"]);
			$newMatch->setPlayerLostColor($matchResult["playerLostColor"]);
			$newMatch->setMatchDate($matchDate);

			$manager->persist($newMatch);
		}
		$manager->flush();
	}

}
