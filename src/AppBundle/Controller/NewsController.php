<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
* 
*/
class NewsController extends Controller
{
	
	public function indexAction($page = 1)
	{
		return $this->render('AppBundle:News:index.html.twig', []);
	}

	public function showAction($id)
	{
		
	}
}

