<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
	public indexAction()
	{
		$response = $this->forward('AppBundle:User:list');

       return $response;
	}

	public lobbyAction() 
	{

	}

	public profileAction($name)
	{
		
	}

	public listAction($page)
	{
		
	}

}