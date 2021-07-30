<?php

namespace Item;

class Book extends Item{
	
	/**
	 * @var int
	 */
	private static $price = 300;

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