<?php
namespace AppBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Security\User\UserProvider as UserProvider;

/**
* 
*/
class UserBaseController extends Controller
{
	protected $_um;

	public function getUserManager()
	{

		return $this->get('db_user_provider');
	}

}