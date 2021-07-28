<?php

namespace Item;
include_once("age.php");

abstract class Item {
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var Age
	 */
	private $age;
	/**
	 * @var int
	 */
	private $price;
	

	public function __construct($name,$age,$price)
	{
		$this->name = $name;
		$this->age = $age;
		$this->price = $price;
	}

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
    	return str_replace("Item\\", "", get_class($this));
    }
}