<?php

spl_autoload_register();
use Item\Stock;
use Item\DVD;
use Item\Book;
class Alquilibros
{
	/**
	 * @var Stock
	 */
	private $books;
	/**
	 * @var Stock
	 */
	private $dvds;
	/**
	 * @var array
	 */
	private $employees = [];

	public function __construct()
	{
		$this->books = new Stock();
		$this->dvds = new Stock();
	}

    /**
     * @return array
     */
    public function getAvailableBooks()
    {
        return $this->books->getAvailable();
    }
    /**
     * @param Book $book
     *
     * @return bool
     */
    public function addBook(Book $book)
    {
    	return $this->books->addItem($book);
    }
    /**
     * @return array
     */
    public function getReservedBooks()
    {
        return $this->books->getReserved();
    }
    /**
     * @param Book $book
     *
     * @return bool
     */
    public function reserveBook(Book $book)
    {
    	return $this->books->reserveItem($book);
    }
    /**
     * @param Book $book
     *
     * @return bool
     */
    public function unReserveBook(Book $book)
    {
    	return $this->books->unReserveItem($book);
    }

    
    
    /**
     * @return array
     */
    public function getAvailableDvds()
    {
        return $this->dvds->getAvailable();
    }
    /**
     * @param DVD $dvd
     *
     * @return bool
     */
    public function addDvd(DVD $dvd)
    {
    	return $this->dvds->addItem($dvd);
    }

    /**
     * @return array
     */
    public function getReservedDvds()
    {
        return $this->dvds->getReserved();
    }
    /**
     * @param DVD $dvd
     *
     * @return bool
     */
    public function reserveDvd(DVD $dvd)
    {
    	return $this->dvds->reserveItem($dvd);
    }
    /**
     * @param DVD $dvd
     *
     * @return bool
     */
    public function unReserveDvd(DVD $dvd)
    {
    	return $this->dvds->unReserveItem($dvd);
    }

    /**
     * @return array
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * 
     * TODO:
     * 
     * * create users
     * * add employees
     * * age restriction for reserves
     * * return reserve price
     * * reserve by title instead of instance
     * 
     * 
     */
}
