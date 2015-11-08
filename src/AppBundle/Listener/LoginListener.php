<?php
namespace AppBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class LoginListener
{
	
	private $securityContext;

	private $em;
	
	public function __construct(TokenStorage $securityContext, Doctrine $doctrine)
	{
		$this->securityContext = $securityContext;
		$this->em              = $doctrine->getManager();
	}
	
	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
	{
		$user = $event->getAuthenticationToken()->getUser();

		if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY') || $this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$user->setLastLogin(new \DateTime());
			$um = $this->em->getRepository('AppBundle:User');

			$um->updateUser($user);
		}
		
	}
}