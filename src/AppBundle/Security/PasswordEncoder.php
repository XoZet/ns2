<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PasswordEncoder implements PasswordEncoderInterface
{

	private $cost;

	public function __construct($cost)
	{
		$this->cost = $cost;
	}

    public function encodePassword($raw, $salt = null)
    {
        return password_hash($raw, PASSWORD_DEFAULT, ['cost' => $this->cost]);
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        
        return password_verify($raw, $encoded);
    }

    public function passwordNeedsRehash($hashedPassword)
    {
    	return password_needs_rehash($hashedPassword, PASSWORD_DEFAULT, ['cost' => $this->cost]);
    }


}