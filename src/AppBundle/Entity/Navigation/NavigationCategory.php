<?php

namespace AppBundle\Entity\Navigation;

/**
* 
*/
class NavigationCategory
{
	
	private $id;

	private $transKey;

	private $access;

	/* GETTER */

	public function getId() {
		return $this->id;
	}

	public function getTransKey() {
		return $this->transKey;
	}

	public function getAccess() {
		return $this->access();
	}

	/* SETTER */

	public function setId($id) {
		$this->id = (int)$id;
	}

	public function setTransKey($transKey) {
		$this->transKey = $transKey;
	}

	public function setAccess($role) {
		$this->access = $role;
	}

}