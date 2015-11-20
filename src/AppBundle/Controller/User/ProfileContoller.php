<?php
namespace AppBundle\Contoller\User

use AppBundle\Controller\User\UserBaseController as BaseController;

/**
* 
*/
class ProfileController extends BaseController
{
	
	public function showAction($username)
	{
		$um = $this->getUserManager();
		$user = $um->loadUserByUsername($username);

		if(!$user) {

		}
		$udm = $this->get('userdata_provider');
		$data = $udm->findDataForUser($user);

		if(!$data) {

		}

		$this->render('AppBundle:User:profile.html.twig', [ 'userdata' => $data]);
	}

	public function editAction()
	{

	}

}