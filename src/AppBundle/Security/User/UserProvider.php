<?php
namespace AppBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider extends EntityRepository implements UserProviderInterface
{
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
        return $class === 'AppBundle\Security\User\User';
    }

    public function updateUser($id, $fields)
    {

        $user = $this->find($id);

        if(!$user)
        {
            throw new UserNameNotFoundException(
                    sprintf('No user with id: %s', $id);
                );
            
        }

        foreach ($fields as $key => $value) 
        {
            $func =  'set' . ucfirst($key);
            $user->$func($value);
        }

        $this->_em->flush();

    }

    public function createUser($data)
    {
        $user = new User();
        foreach ($data as $key => $value) 
        {
            $func =  'set' . ucfirst($key);
            $user->$func($value);
        }

        $this->_em->persist($user);
        $this->_em->flush;
    }
}