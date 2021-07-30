<?php

namespace Item;
use AgeRange;

abstract class Item {
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var AgeRange
	 */
	private $ageRange;
	/**
	 * @var int
	 */
	private static $price = 0;
	

	public function __construct($name,$ageRange)
	{
		$this->name = $name;
		$this->ageRange = $ageRange;
	}

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return AgeRange
     */
    public function getAge()
    {
        return $this->ageRange;
    }

    /**
     * @return int
     */
    public static abstract function getPrice();

    /**
     * @return string
     */
    public function getClassName()
    {
    	return str_replace("Item\\", "", get_class($this));
    }
    /**
     * @param int $age
     * @return bool
     */
    public function isApt(int $age)
    {
        return $this->ageRange->isApt($age);
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return "class: " . $this->getClassName() . ", name: " . $this->name . ", price: ". number_format($this->getPrice() /100.0,2) . "€, age range:{". $this->ageRange."}";
    }
}