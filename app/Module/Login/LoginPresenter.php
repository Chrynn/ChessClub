<?php declare(strict_types = 1);

namespace App\Module\Login;

use App\Model\Facade\Auth\AuthorizationFacade;
use App\Module\ModulePresenter;

class LoginPresenter extends ModulePresenter
{

	public function __construct(AuthorizationFacade $authorizationFacade)
	{
		parent::__construct($authorizationFacade);
	}

}
