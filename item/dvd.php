<?php

namespace Item;
include "item.php";

class DVD extends Item{
	
	

	public function __construct($name,$age)
	{
		parent::__construct($name,$age,500);
	}
}