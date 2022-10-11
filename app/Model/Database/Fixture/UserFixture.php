<?php declare(strict_types = 1);

namespace App\Model\Database\Fixture;

use App\Model\Database\Entity\UserEntity;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Nette\Neon\Neon;
use Nette\Security\Passwords;

final class UserFixture implements FixtureInterface
{

	public function load(ObjectManager $manager): void
	{
		$users = Neon::decodeFile(__DIR__ . '/content/user.neon');

		foreach ($users as $user) {
			$passwords = new Passwords();
			$passwordHash = $passwords->hash($user['password']);

			$newUser = new UserEntity();
			$newUser->setNickname($user['nickname']);
			$newUser->setPassword($passwordHash);

			$manager->persist($newUser);
		}
		$manager->flush();
	}

}
