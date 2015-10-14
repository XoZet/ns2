<?php
namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
/**
* 
*/
class UserData
{
	
	protected $id;

	protected $firstName;

	protected $lastName;

	protected $lastName;

	protected $playerName;

	protected $birthDate;

	protected $user;

	/* GETTER */

	public function getId()
	{
		return $this->id;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function getPlayerName()
	{
		return $this->playerName;
	}

	public function getBirthDate($format = null)
	{
		if(!is_null($format)) {
			return $this->birthDate->format($format);
		}

		return $this->birthDate;
	}

	public function getUser()
	{
		return $this->user;
	}

	/* SETTER */

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;

	}

	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	public function setPlayerName($playerName)
	{
		$this->playerName = $playerName;
	}

	public function setBirthDate(\DateTime $birthDate)
	{
		$this->birthDate = $birthDate;
	}

	public function setUser(UserInterface $user)
	{
		$this->user = $user;
	}
}