<?php declare(strict_types = 1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{

	use Nette\StaticClass;


	public static function createRouter(): RouteList
	{

		$routerLogin = new RouteList("Login");
		$routerLogin->addRoute('login/<presenter>/<action>[/<id>]', 'Homepage:default');

		$routerUser = new RouteList("User");
		$routerUser->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');

		$router = new RouteList();
		$router->add($routerLogin);
		$router->add($routerUser);

		return $router;
	}

}
