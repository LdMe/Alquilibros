<?php

namespace Item;
include_once("item.php");

class Book extends Item{
	
	

	public function __construct($name,$age)
	{
		parent::__construct($name,$age,300);
	}
}