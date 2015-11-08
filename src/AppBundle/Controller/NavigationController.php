<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavigationController extends Controller
{
	public function renderAction()
	{
		$nav = [
				'Main Navigation' => [
						'News' => 'news',
						'Clanwars' => 'clanwar'
					]
			];
		return $this->render('AppBundle:Navigation:nav.html.twig',
			[ 
				'nav' => $nav,
				'has_cat' => true
			]);
	}
}