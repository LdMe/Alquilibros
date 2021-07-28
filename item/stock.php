<?php
namespace Item;
define("DEBUG",true);
class Stock {
	/**
	 * @var array
	 */
	private $reserved = [];
	/**
	 * @var array
	 */
	private $available = [];
	

    /**
     * @return array
     */
    public function getReserved()
    {
    	return $this->reserved;
    }
    /**
     * @param Item $item
     *
     * @return bool
     */
    public function addItem(Item $item)
    {
    	if(!in_array($item,$this->available))
    	{
    		if(in_array($item,$this->reserved))
    		{
    			if(DEBUG){
    				echo $item->getClassName() . " '".$item->getName() ."' already reserved\n";
    			}
    			return false;
    		}
    		$this->available[] = $item;
    		if(DEBUG)
	    	{
	    		echo $item->getClassName() . " '".$item->getName() ."' added to stock\n";
	    	}
    		return true;
    	}
    	if(DEBUG)
    	{
    		echo $item->getClassName() . " '".$item->getName() ."' already exists\n";
    	}
    	return false;
    }

    /**
     * @param Item $item
     *
     * @return bool
     */
    public function reserveItem(Item $item)
    {
    	if(in_array($item,$this->reserved))
    	{
    		if(DEBUG)
    		{
    			echo $item->getClassName() . " '".$item->getName() ."' already reserved\n";
    		}
    		return false;
    	}
    	if(in_array($item,$this->available))
    	{
    		$this->reserved[] = $item;
    		$index = array_search($item, $this->available);
    		array_splice($this->available, $index, 1);
    		if(DEBUG)
	    	{
	    		echo $item->getClassName() . " '".$item->getName() ."' reserved successfully\n";
	    	}
    		return true;
    	}
    	if(DEBUG)
    	{
    		echo $item->getClassName() . " '".$item->getName() ."' doesn't exist\n";
    	}
    	return false;
    }

    /**
     * @param Item $item
     *
     * @return bool
     */
    public function unReserveItem(Item $item)
    {
    	if(in_array($item,$this->reserved))
    	{
    		$this->available[] = $item;
    		$index = array_search($item, $this->reserved);
    		array_splice($this->reserved, $index, 1);
    		if(DEBUG)
	    	{
	    		echo $item->getClassName() . " '".$item->getName() ."' returned to stock\n";
	    	}
    		return true;
    	}
    	if(DEBUG)
    	{
    		echo $item->getClassName() . " '".$item->getName() ."' is not reserved\n";
    	}
    	return false;
    }

    /**
     * @return array
     */
    public function getAvailable()
    {
    	return $this->available;
    }
}