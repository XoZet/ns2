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

		return $this->_um;
	}

	public function setUserManager($userProvider)
	{
		$this->_um = $userProvider;
	}

}