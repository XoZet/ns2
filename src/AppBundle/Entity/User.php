<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

class User extends BaseUser
{

    protected $id;

    protected $regDate;

    public function __construct()
    {
        parent::__construct();
    }



    public function getSalt()
    {
        return null;
    }

    public function getLastLogin($format = null)
    {
        if(!is_null($format))
        {
            return date_format($this->lastLogin, $format);
        }
        return $this->lastLogin;
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


    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->password,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
            $this->regDate
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->password,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
            $this->regDate
        ) = $data;
    }
}