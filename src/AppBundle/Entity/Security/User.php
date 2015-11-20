<?php
namespace AppBundle\Entity\Security;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;


class User implements AdvancedUserInterface, EquatableInterface, \Serializable
{
    /* ATTRIBUTES */

    protected $id;

    protected $username;

    protected $password;

    protected $plainPassword;

    protected $email;

    protected $confirmationToken;

    protected $enabled;

    protected $roles;

    protected $registrationDate;

    protected $lastLogin;

    protected $expired;

    protected $expirationDate;

    protected $pwResetRequestDate;

    public function __construct()
    {
        $this->enabled = false;
        $this->registrationDate = new \DateTime();
        $this->expired = false;
        $this->roles = ['ROLES_USER'];
    }

    /* GETTER */ 

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function getRoles()
    {
        return $roles;
    }

    public function getregistrationDate($format = null)
    {
        
        if(!is_null($format))
        {
            return date_format($this->registrationDate, $format);
        }

        return $this->registrationDate;

    }

    public function getLastLogin($format = null)
    {

        if(!is_null($format))
        {
            return date_format($this->lastLogin, $format);
        }

        return $this->lastLogin;
    }

    public function getPwResetRequestDate()
    {
        return $this->pwResetRequestDate;
    }

    /* SETTER */

    public function setId($id)
    {
        $this->id = $id;
    }    

    public function setUsername($username) 
    {
        $this->username = $username;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function setregistrationDate(\DateTime $registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }

    public function setLastLogin(\DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    public function setPwResetRequestDate(\DateTime $pwResetRequestDate)
    {
        $this->pwResetRequestDate = $pwResetRequestDate;
    }

    /* INTERFACE FUNCTIONS */ 

    public function getSalt()
    {
        return null;
    }

    public function isAccountNonExpired()
    {
        if (true === $this->expired) {
            return false;
        }

        if(null !== $this->expiresAt && $this->expiresAt->getTimestamp() > time())
        {
            $this->expired = true;
        } else {
            $this->expired = false;
        }

        return !$this->expired;
        
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
        return $this->enabled;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function isEqualTo(UserInterface $user)
    {
        if(!($this->id == $user->id))
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
            $this->email,
            $this->roles,
            $this->enabled,
            $this->confirmationToken,
            $this->registrationDate,
            $this->lastLogin,
            $this->expirationDate,
            $this->pwResetRequestDate
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->roles,
            $this->enabled,
            $this->confirmationToken,
            $this->registrationDate,
            $this->lastLogin,
            $this->expirationDate,
            $this->pwResetRequestDate
        ) = unserialize($serialized);
    }

    /* ADDITIONAL FUNCTIONS */ 

    public function addRole($role)
    {
        $role = strtoupper($role);
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    
}