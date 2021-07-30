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
	/**
	 * @var int
	 */
	private static $count = 0;
	/**
	 * @var int
	 */
	private $id;
	
	


	public function __construct($name,$age)
	{
		$this->id = self::$count;
		self::$count++;
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


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "id: " . $this->id . ", name: " . $this->name . ", age: ". $this->age;
    }
}