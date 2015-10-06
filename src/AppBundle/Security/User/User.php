<?php
namespace AppBundle\Security\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;


class User implements AdvancedUserInterface, \Serializable
{

    private $id;

    private $username;

    private $password;

    private $email;

    private $emailAuth;

    private $isActive;

    private $roles;

    private $regDate;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username) 
    {
        $this->username = $username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmailAuth()
    {
        return $this->emailAuth;
    }

    public function setEmailAuth($emailAuth)
    {
        $this->emailAuth = $emailAuth;
    }

    public function getRoles()
    {
        return $roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getRegDate($format = null)
    {
        
        if(!is_null($format))
        {
            return date_format($this->regDate, $format);
        }

        return $this->regDate;

    }

    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        if(!($this->id == $user->id))
        {
            return false;
        }
        if(!($this->username == $user->username))
        {
            return false;
        }
        if(!($this->password == $user->password))
        {
            return false;
        }
        if(!($this->regDate == $user->regDate)
        {
            return false;
        }
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->roles,
            $this->isActive,
            $this->emailAuth,
            $this->regDate
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->roles,
            $this->isActive,
            $this->emailAuth,
            $this->regDate
        ) = unserialize($serialized);
    }
}