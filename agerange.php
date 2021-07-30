<?php

class AgeRange {
	/**
	 * @var int
	 */
	private $minAge;
	/**
	 * @var int
	 */
	private $maxAge;
	/**
	 * @var string
	 */
	private $name;

	public function __construct(string $name,int $minAge,int $maxAge = -1)
	{
		$this->name = $name;
		// si la edad mínima es menor que 0 la ponemos a 0
		$this->minAge = $minAge >= 0 ? $minAge: 0;
		// si la edad máxima es menor que la mínima, la ponemos a -1 que en nuestro caso equivale a "sin límite"
		$this->maxAge = $maxAge >= $this->minAge ? $maxAge : -1;
	}
	
	public function isApt($age)
	{
		if($age < $this->minAge) {
			return false;
		}
		if($this->maxAge > -1 && $age > $this->maxAge) {
			return false;
		}
		return true;
	}

	public function getName()
	{
		return $this->name;
	}
	public function getMinAge()
	{
		return $this->minAge;
	}
	public function getMaxAge()
	{
		return $this->maxAge;
	}

	/**
     * @return string
     */
    public function __toString()
    {
    	$maxAge = $this->maxAge > -1 ? $this->maxAge : " no limit";
        return " name: " . $this->name . ", min age: ". $this->minAge . ", max age: " . $maxAge ;
    }
}