<?php
namespace AppBundle\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityRepository;

use AppBundle\Entity\Security\User as User;
use AppBundle\Entity\UserData as UserData;

class UserDataProvider extends EntityRepository
{

	public function findDataForUser(UserInterface $user) 
	{

		$userData = $this->createQueryBuilder('u')
            ->where('u.user = :id')
            ->setParameter('id', $user->getId())
            ->getQuery()
            ->getOneOrNullResult();

        return $userData;

	}

}