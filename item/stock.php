<?php
namespace Item;
use User;


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
     * @var int
     */
    const OK = 0;
    /**
     * @var int
     */
    const NOT_FOUND = 1;
    /**
     * @var int
     */
    const EXISTS = 2;
    /**
     * @var int
     */
    const RESERVED = 3;
    /**
     * @var int
     */
    const NOT_RESERVED = 4;
    /**
     * @var int
     */
    const NOT_RESERVED_BY_USER = 5;
    /**
     * @var int
     */
    const NOT_SUITABLE = 6;
    
    


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
     * @return int
     */
    public function addItem(Item $item)
    {
    	if(!array_key_exists($item->getName(),$this->available))
    	{
            // el elemento ya ha sido reservado
    		if(in_array($item,$this->reserved))
    		{
    			return self::RESERVED;
    		}
    		$this->available[$item->getName()] = $item;
            return self::OK;
        }
        return self::EXISTS;
    }


    /**
     * @param string $title
     * @param User $user
     *
     * @return int
     */
    public function reserveItem(string $title, User $user)
    {
        $userId = $user->getId();
        // Si el usuario ya ha reservado, no puede reservar otra vez
        if(array_key_exists($userId,$this->reserved))
        {
            return self::RESERVED;
        }
        // el item está disponible para alquiler
        if(array_key_exists($title,$this->available))
        {
            $item = $this->available[$title];
            // si la edad del usuario no es adecuada, devuelve falso
            if(!$item->isApt($user->getAge()))
            {
                return self::NOT_SUITABLE;
            }
            $this->reserved[$userId] = $this->available[$title]; 
            
            unset($this->available[$title]); 
            return self::OK;
        }
        return self::NOT_FOUND;

    }

    /**
     * @param string $title
     * @param User $user
     *
     * @return int
     */
    public function unReserveItem(string $title, User $user)
    {
        $userId = $user->getId();
        if(array_key_exists($userId,$this->reserved))
        {
            if($title != $this->reserved[$userId]->getName())
            {
                return self::NOT_RESERVED_BY_USER;
            }
            $this->available[$title] = $this->reserved[$userId];
            unset($this->reserved[$userId]);
            return self::OK;
        }
        return self::NOT_RESERVED;

    }

    /**
     * @return array
     */
    public function getAvailable()
    {
    	return $this->available;
    }
    /**
     * @param User $user
     * @return bool
     */
    public function userHasAreserve(User $user)
    {
        return array_key_exists($user->getId(),$this->reserved);
    }
}