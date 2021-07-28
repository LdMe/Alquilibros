<?php

class User 
{
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var int
	 */
	private $age;

	public function __construct($name,$age)
	{
		$this->name = $name;
		$this->age = $age;
	}	


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }
}