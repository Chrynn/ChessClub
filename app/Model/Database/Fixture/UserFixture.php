<?php declare(strict_types = 1);

namespace App\Model\Database\Fixture;

use App\Model\Database\Entity\UserEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Nette\Neon\Neon;
use Nette\Security\Passwords;
use Nette\Utils\DateTime;

final class UserFixture implements FixtureInterface
{

	public function load(ObjectManager $manager): void
	{
		$dateNow = new \DateTime("now");
		$users = Neon::decodeFile(__DIR__ . '/content/user.neon');

		foreach ($users as $user) {
			if (array_key_exists("joinedAt", $user)) {
				$joinedAt = DateTime::createFromImmutable($user["joinedAt"]);
			} else {
				$joinedAt = $dateNow;
			}
			$passwords = new Passwords();
			$passwordHash = $passwords->hash($user['password']);

			$newUser = new UserEntity();
			$newUser->setNickname($user['nickname']);
			$newUser->setPassword($passwordHash);
			$newUser->setJoinedAt($joinedAt);

			$manager->persist($newUser);
		}
		$manager->flush();
	}

}
