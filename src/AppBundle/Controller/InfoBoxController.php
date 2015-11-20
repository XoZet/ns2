<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoBoxController extends Controller
{
	public function newsAction(){
		return $this->render('AppBundle:Infobox:news.html.twig', []);
	}

	public function forumAction(){
		return $this->render('AppBundle:Infobox:forum.html.twig', []);
	}

	public function lastCWAction(){
		return $this->render('AppBundle:Infobox:lastcw.html.twig', []);
	}

	public function nextCWAction(){
		return $this->render('AppBundle:Infobox:nextcw.html.twig', []);
	}

}