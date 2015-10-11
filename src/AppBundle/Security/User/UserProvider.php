<?php
namespace AppBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Doctrine\ORM\EntityRepository;

use AppBundle\Entity\Security\User as User;

class UserProvider extends EntityRepository implements UserProviderInterface
{  
    protected $pwEncoder;

    public function setPwEncoder($pwEncoder)
    {
        $this->pwEncoder = $pwEncoder;
    }

    public function loadUserByUsername($username)
    {
        
        $user = $this->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
        

        if ($user) {
            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === $this->getClass();
    }

    public function updateUser(User $user)
    {   

        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $this->_em->merge($user);
        $this->_em->flush();


    }

    public function createUser()
    {
        $user = new User();

        return $user;
    }

    public function registerNewUser(User &$user)
    {
        $confToken = \md5($user->getUsername() . $user->getEmail() . time());
        $user->setConfirmationToken($confToken);
        $passwordHash = $this->pwEncoder->encodePassword($user->getPlainPassword());
        $user->eraseCredentials();

        $this->_em->persist($user);
        $this->_em->flush();

    }
}