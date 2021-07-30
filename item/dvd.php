<?php

namespace Item;

class DVD extends Item{
	
	
	/**
	 * @var int
	 */
	private static $price = 500;

	public function __construct($name,$ageRange)
	{
		parent::__construct($name,$ageRange);
	}
	/**
     * @return int
     */
    public static function getPrice()
    {
        return self::$price;
    }
}