<?php

namespace AppBundle\Entity\Navigation;

/**
* 
*/
class NavigationItem
{
	
	private $id;

	private $category;

	private $transKey;

	private $route;

	/* GETTER */

	public function getId() {
		return $this->id;
	}

	public function getCategory() {
		return $this->category;
	}

	public function getTransKey() {
		return $this->transKey;
	}

	public function getRoute() {
		return $this->route;
	}

	/* SETTER */

	public function setId($id) {
		$this->id = (int)$id;
	}

	public function setCategory($category) {
		$this->category = $category;
	}

	public function setTransKey($transKey) {
		$this->transKey = $transKey;
	}

	public function setRoute($route) {
		$this->route = $route;
	}

}